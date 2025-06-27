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
    Schema::create('asistencia_docentes', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('personal_id'); // docente
    $table->unsignedBigInteger('asignacion_id');
    $table->date('fecha');
    $table->string('estado'); // PRESENTE, FALTA, TARDANZA, FJ
    $table->string('observacion')->nullable();
    $table->timestamps();

    $table->foreign('personal_id')->references('id')->on('personals');
    $table->foreign('asignacion_id')->references('id')->on('asignacions');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia_docentes');
    }
};
