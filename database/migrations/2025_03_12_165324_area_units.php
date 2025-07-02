<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('area_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained(table: 'area')->onDelete('cascade');
            $table->string('unit_name');
            $table->tinyInteger('default_people');
            $table->tinyInteger('max_people');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_units');
    }
};