<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facility_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade');
            $table->string('unit_name'); // misalnya "Deck 1", "Plot 5"
            $table->unsignedTinyInteger('default_people');
            $table->unsignedTinyInteger('max_people');
            $table->decimal('extra_charge', 10, 2); // tambahan biaya per orang melebihi default
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_units');
    }
};
