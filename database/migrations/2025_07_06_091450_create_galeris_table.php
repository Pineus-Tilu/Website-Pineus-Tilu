<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) { // Ubah dari 'galeris' ke 'galeri'
            $table->id();
            $table->foreignId('area_id')->nullable()->constrained('area')->onDelete('cascade');
            $table->foreignId('facility_id')->nullable()->constrained('facility')->onDelete('cascade');
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['dashboard', 'facility'])->default('facility');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri'); // Ubah dari 'galeris' ke 'galeri'
    }
};