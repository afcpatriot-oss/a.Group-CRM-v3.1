<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Baseline table. Business fields (statuses, sales models, antifraud, etc)
        // будут добавлены позже осознанно, после выравнивания с платформой.
        Schema::create('orders', function (Blueprint $table) {
            // Grow CRM-style PK (explicit)
            $table->bigIncrements('order_id');

            // Minimal client identity layer (you already use these fields)
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('phone')->nullable();

            // Optional future-proof placeholders (safe)
            $table->string('source_type')->nullable(); // manual / preland / land / api etc (you will finalize later)
            $table->unsignedBigInteger('user_id')->nullable(); // creator/operator

            // Platform timestamps
            $table->timestamps();

            // Indexes (minimal)
            $table->index('phone');
            $table->index('user_id');
            $table->index('source_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};