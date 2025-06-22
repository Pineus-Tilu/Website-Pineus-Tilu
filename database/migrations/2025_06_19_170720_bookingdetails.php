<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->integer('number_of_people');
            $table->decimal('extra_charge', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->date('check_in');
            $table->date('check_out');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
