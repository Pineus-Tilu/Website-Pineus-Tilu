<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->string('transaction_id')->unique(); // Hapus unique() dan tambah nullable()
            $table->string('payment_type');
            $table->string('transaction_status');
            $table->string('fraud_status')->nullable();
            $table->decimal('gross_amount', 10, 2);
            $table->date('expired_at')->nullable();
            $table->text('qr_url')->nullable();
            $table->text('qr_string')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
