<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VapiService
{
    private function client(): PendingRequest
    {
        $baseUrl = rtrim((string) config('services.vapi.base_url'), '/');
        $apiKey = (string) config('services.vapi.api_key');

        return Http::baseUrl($baseUrl)
            ->acceptJson()
            ->asJson()
            ->withToken($apiKey);
    }

    /**
     * Create an outbound phone call via Vapi.
     *
     * Note: Vapi's exact payload fields depend on your telephony setup
     * (Twilio/number provisioning). This method is designed to be easy
     * to adjust once the specific Vapi call schema is confirmed.
     *
     * @param  string  $toPhoneNumber  E.164 preferred, e.g. +15551234567
     * @param  string|null  $assistantId  Defaults to services.vapi.assistant_id
     * @param  array<string,mixed>  $metadata
     * @return array<string,mixed>|null
     */
    public function createOutboundCall(string $toPhoneNumber, ?string $assistantId = null, array $metadata = []): ?array
    {
        $assistantId = $assistantId ?: (string) config('services.vapi.assistant_id');

        if (blank($assistantId) || blank(config('services.vapi.api_key'))) {
            Log::warning('Vapi outbound call skipped: missing VAPI_ASSISTANT_ID or VAPI_API_KEY');
            return null;
        }

        $payload = [
            // Common fields (may need adjustment per your Vapi account settings):
            'assistantId' => $assistantId,
            'customer' => [
                'number' => $toPhoneNumber,
            ],
            'metadata' => array_merge([
                'requestId' => (string) Str::uuid(),
            ], $metadata),
        ];

        $response = $this->client()->post('/calls', $payload);

        if (!$response->successful()) {
            Log::error('Vapi outbound call failed', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
            return null;
        }

        return $response->json();
    }

    /**
     * Verify webhook signature using a shared secret (simple HMAC scheme).
     *
     * If your Vapi account uses a different signature header format, update this
     * method to match (e.g. vapi-signature, timestamps, etc).
     */
    public function verifyWebhookSignature(string $rawBody, ?string $signatureHeader): bool
    {
        $secret = (string) config('services.vapi.webhook_secret');
        if (blank($secret) || blank($signatureHeader)) {
            return false;
        }

        // Expect header like: "sha256=<hex>"
        $signatureHeader = trim($signatureHeader);
        $parts = explode('=', $signatureHeader, 2);
        $provided = $parts[1] ?? $signatureHeader;

        $computed = hash_hmac('sha256', $rawBody, $secret);

        return hash_equals($computed, $provided);
    }
}

