<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServioWebhookController extends Controller
{
    /**
     * Handle incoming orders from Servio voice AI
     * POST /api/servio/order
     */
    public function order(Request $request): JsonResponse
    {
        $data = $request->validate([
            'id' => 'nullable|string',
            'customer_name' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'nullable|email',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'nullable|numeric',
            'items.*.options' => 'nullable|array',
            'total' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        // Check for duplicate
        if (!empty($data['id'])) {
            $existing = Order::where('external_id', $data['id'])->first();
            if ($existing) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order already exists',
                    'order_id' => $existing->id,
                ]);
            }
        }

        // Create the order
        $order = Order::fromVoiceOrder($data);

        // Also create/update lead
        if (!empty($data['phone_number'])) {
            Lead::updateOrCreate(
                ['phone_number' => $data['phone_number']],
                [
                    'name' => $data['customer_name'] ?? null,
                    'email' => $data['email'] ?? null,
                    'status' => 'contacted',
                    'notes' => "Voice order #{$order->id}",
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'order_id' => $order->id,
        ]);
    }

    /**
     * Get menu items for Servio to use as knowledge base
     * GET /api/servio/menu
     */
    public function menu(): JsonResponse
    {
        // TODO: Fetch from TastyIgniter menu system
        // For now, return sample structure
        return response()->json([
            'menu' => [
                'categories' => [
                    ['id' => 1, 'name' => 'Appetizers'],
                    ['id' => 2, 'name' => 'Main Course'],
                    ['id' => 3, 'name' => 'Desserts'],
                    ['id' => 4, 'name' => 'Beverages'],
                ],
                'items' => [
                    ['id' => 1, 'name' => 'Sample Item', 'price' => 9.99, 'available' => true],
                ],
            ],
            'hours' => [
                'monday' => ['open' => '11:00', 'close' => '22:00'],
                'tuesday' => ['open' => '11:00', 'close' => '22:00'],
                // ... etc
            ],
        ]);
    }
}
