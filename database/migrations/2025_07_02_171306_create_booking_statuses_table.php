<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // success, pending, cancel
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Insert default status values
        DB::table('booking_statuses')->insert([
            ['name' => 'pending', 'description' => 'Booking is pending confirmation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'success', 'description' => 'Booking confirmed successfully', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cancel', 'description' => 'Booking has been cancelled', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_statuses');
    }
};