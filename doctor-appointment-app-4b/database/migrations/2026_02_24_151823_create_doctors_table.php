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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            // Relaciones
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->nullable()->constrained();
            // Campos con los nombres exactos de la captura:
            $table->string('medical_license_number')->nullable(); // Cédula
            $table->text('biography')->nullable();                // Biografía

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
