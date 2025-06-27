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
        Schema::create('detalle_asistencias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asistencia_id')->constrained('asistencias')->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
            $table->enum('estado_asistencia', ['PRESENTE','FALTA','TARDANZA','FJ']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_asistencias');
    }
};
