<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $column) {
            $column->id();
            $column->string('name');
            $column->string('phone_number')->unique();
            $column->string('email')->nullable();
            $column->string('status')->default('pending'); // pending, contacted, converted, etc.
            $column->text('notes')->nullable();
            $column->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
