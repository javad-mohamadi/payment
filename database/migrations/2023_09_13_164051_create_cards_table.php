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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('number')->unique();
            $table->string('cvv2',4);
            $table->string('static_second_password')->nullable();
            $table->unsignedInteger('limit_dynamic_password_transfer')->default(config('transfer.limit_dynamic_password_transfer'));
            $table->unsignedInteger('limit_static_password_transfer')->default(config('transfer.limit_static_password_transfer'));
            $table->string('type');
            $table->date('expire_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
