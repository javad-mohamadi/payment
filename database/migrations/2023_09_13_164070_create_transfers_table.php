<?php

use App\Enum\BankEnum;
use App\Enum\TransferEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_card_id')
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dest_card_id')->nullable()
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('dest_card_number');
            $table->string('dest_bank')->default(BankEnum::SNAPP_SHOP->value);
            $table->unsignedBigInteger('amount');
            $table->string('status')->default(TransferEnum::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
