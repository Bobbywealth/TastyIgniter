<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique()->nullable();
            $table->string('customer_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('items'); // JSON array of order items
            $table->decimal('total', 10, 2)->default(0);
            $table->string('status')->default('pending'); // pending, confirmed, preparing, ready, completed, cancelled
            $table->text('notes')->nullable();
            $table->string('source')->default('voice'); // voice, web, app
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
