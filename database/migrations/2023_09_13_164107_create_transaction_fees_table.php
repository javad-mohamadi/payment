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
        Schema::create('transaction_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transfer_id')->constrained('transfers')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('bank_account_id')->constrained('accounts')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_fees');
    }
};
