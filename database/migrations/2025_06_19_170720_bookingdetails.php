<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->integer('additional_people')->default(0); // Jumlah orang melebihi standar
            $table->decimal('extra_charge', 10, 2)->default(0); // Biaya tambahan
            $table->text('notes')->nullable(); // Catatan tambahan jika dibutuhkan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
