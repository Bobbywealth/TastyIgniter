<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'customer_name',
        'phone_number',
        'email',
        'items',
        'total',
        'status',
        'notes',
        'source',
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'decimal:2',
    ];

    public static function fromVoiceOrder(array $data): self
    {
        return self::create([
            'external_id' => $data['id'] ?? null,
            'customer_name' => $data['customer_name'] ?? $data['name'] ?? null,
            'phone_number' => $data['phone_number'] ?? $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'items' => $data['items'] ?? [],
            'total' => $data['total'] ?? 0,
            'status' => 'pending',
            'notes' => $data['notes'] ?? null,
            'source' => 'voice',
        ]);
    }
}
