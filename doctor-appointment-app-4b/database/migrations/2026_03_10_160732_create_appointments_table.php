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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        // Relación con doctores y pacientes
        $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
        $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        
        $table->date('date');
        $table->time('start_time');
        $table->time('end_time');
        
        // Estado de la cita
        $table->enum('status', ['Scheduled', 'Confirmed', 'Cancelled', 'Completed'])->default('Scheduled');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}
};
