<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            // Relaciona el horario con una asignación específica
            $table->foreignId('asignacion_id')->constrained('asignacions')->onDelete('cascade');
            // Almacena el día de la semana (1 para Lunes, 7 para Domingo)
            $table->tinyInteger('dia_semana');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};