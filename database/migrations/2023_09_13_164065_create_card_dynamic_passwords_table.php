<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('card_dynamic_passwords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('dest_card_number')->unique();
            $table->string('amount');
            $table->string('password');
            $table->boolean('used')->default(0);
            $table->timestamp('expire_at');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_dynamic_passwords');
    }
};
