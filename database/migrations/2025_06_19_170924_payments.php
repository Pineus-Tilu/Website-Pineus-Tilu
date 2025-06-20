<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            
            $table->string('order_id')->unique(); // ID dari Midtrans
            $table->string('transaction_id')->nullable(); // Dari Midtrans
            $table->string('payment_type')->nullable(); // gopay, bank_transfer, etc
            $table->string('transaction_status')->default('pending'); // pending, settlement, cancel, expire, etc
            $table->string('fraud_status')->nullable(); // accept, challenge
            // $table->string('status_code')->nullable(); // Kode HTTP dari Midtrans
            $table->decimal('gross_amount', 10, 2); // Total pembayaran
            $table->json('response')->nullable(); // Respons JSON Midtrans (opsional)
            $table->string('snaptoken')->unique(); // Token untuk Snap Midtrans

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
