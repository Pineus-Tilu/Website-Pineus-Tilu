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
        Schema::create('price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('area_units')->onDelete('cascade');
            $table->decimal('Weekday', 10, 2)->default(0);
            $table->decimal('Weekend', 10, 2)->default(0);
            $table->decimal('High_season', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price');
    }
};
