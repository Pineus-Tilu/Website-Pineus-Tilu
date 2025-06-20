<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('facility_units')->onDelete('set null');
            
            $table->date('booking_date'); // tanggal user melakukan pemesanan
            $table->date('check_in');     // tanggal mulai reservasi
            $table->date('check_out');    // tanggal selesai reservasi
            
            $table->integer('number_of_people');
            $table->decimal('price', 10, 2); // total harga (otomatis dihitung)
            
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
