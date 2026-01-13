<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\VapiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VapiWebhookController extends Controller
{
    public function handle(Request $request, VapiService $vapi): JsonResponse
    {
        $rawBody = (string) $request->getContent();

        $signature = $request->header('X-Vapi-Signature')
            ?? $request->header('Vapi-Signature')
            ?? $request->header('X-Signature')
            ?? $request->header('Signature');

        $webhookSecretConfigured = !blank(config('services.vapi.webhook_secret'));
        $signatureValid = $webhookSecretConfigured ? $vapi->verifyWebhookSignature($rawBody, $signature) : true;

        if (!$signatureValid) {
            Log::warning('Rejected Vapi webhook: invalid signature', [
                'ip' => $request->ip(),
            ]);

            return response()->json(['error' => 'invalid_signature'], 401);
        }

        $payload = $request->json()->all();

        // Attempt to interpret this webhook as a tool/function call first.
        $tool = $this->extractToolCall($payload);
        if ($tool !== null) {
            return $this->handleToolCall($tool['name'], $tool['arguments'] ?? []);
        }

        // Otherwise treat it as an event/notification webhook and log it.
        // You can expand this to persist transcripts, call summaries, etc.
        Log::info('Vapi webhook event received', [
            'type' => $payload['type'] ?? null,
            'event' => $payload['event'] ?? null,
            'metadata' => $payload['metadata'] ?? null,
        ]);

        // If we can associate a lead, mark them as contacted.
        $leadId = data_get($payload, 'metadata.leadId') ?? data_get($payload, 'metadata.lead_id');
        if ($leadId) {
            $lead = Lead::find($leadId);
            if ($lead) {
                $lead->status = $lead->status === 'pending' ? 'contacted' : $lead->status;
                $lead->save();
            }
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Extract tool call from various possible payload shapes.
     *
     * @return array{name:string,arguments:array<string,mixed>}|null
     */
    private function extractToolCall(array $payload): ?array
    {
        // Shape A: { tool: { name, arguments } }
        $name = data_get($payload, 'tool.name');
        $arguments = data_get($payload, 'tool.arguments');
        if (is_string($name) && is_array($arguments)) {
            return ['name' => $name, 'arguments' => $arguments];
        }

        // Shape B: { toolCall: { name, arguments } }
        $name = data_get($payload, 'toolCall.name');
        $arguments = data_get($payload, 'toolCall.arguments');
        if (is_string($name) && is_array($arguments)) {
            return ['name' => $name, 'arguments' => $arguments];
        }

        // Shape C: { message: { toolCall: { name, arguments } } }
        $name = data_get($payload, 'message.toolCall.name');
        $arguments = data_get($payload, 'message.toolCall.arguments');
        if (is_string($name) && is_array($arguments)) {
            return ['name' => $name, 'arguments' => $arguments];
        }

        return null;
    }

    private function handleToolCall(string $name, array $arguments): JsonResponse
    {
        return match ($name) {
            'ping' => response()->json(['result' => ['ok' => true]]),

            // Lead tools (useful for marketing qualification + support)
            'get_lead_by_phone' => $this->toolGetLeadByPhone($arguments),
            'update_lead' => $this->toolUpdateLead($arguments),

            default => response()->json([
                'error' => 'unknown_tool',
                'tool' => $name,
            ], 400),
        };
    }

    private function toolGetLeadByPhone(array $arguments): JsonResponse
    {
        $phone = (string) ($arguments['phone_number'] ?? $arguments['phone'] ?? '');
        if (blank($phone)) {
            return response()->json(['error' => 'missing_phone_number'], 422);
        }

        $lead = Lead::query()->where('phone_number', $phone)->first();
        if (!$lead) {
            return response()->json(['result' => null]);
        }

        return response()->json([
            'result' => [
                'id' => $lead->id,
                'name' => $lead->name,
                'phone_number' => $lead->phone_number,
                'email' => $lead->email,
                'status' => $lead->status,
                'notes' => $lead->notes,
                'created_at' => optional($lead->created_at)->toISOString(),
                'updated_at' => optional($lead->updated_at)->toISOString(),
            ],
        ]);
    }

    private function toolUpdateLead(array $arguments): JsonResponse
    {
        $leadId = $arguments['lead_id'] ?? $arguments['leadId'] ?? null;
        $phone = $arguments['phone_number'] ?? $arguments['phone'] ?? null;

        $lead = null;
        if ($leadId) {
            $lead = Lead::find($leadId);
        } elseif ($phone) {
            $lead = Lead::query()->where('phone_number', $phone)->first();
        }

        if (!$lead) {
            return response()->json(['error' => 'lead_not_found'], 404);
        }

        if (array_key_exists('status', $arguments) && is_string($arguments['status'])) {
            $lead->status = $arguments['status'];
        }

        if (array_key_exists('notes', $arguments) && (is_string($arguments['notes']) || $arguments['notes'] === null)) {
            $lead->notes = $arguments['notes'];
        }

        $lead->save();

        return response()->json([
            'result' => [
                'updated' => true,
                'lead_id' => $lead->id,
            ],
        ]);
    }
}

