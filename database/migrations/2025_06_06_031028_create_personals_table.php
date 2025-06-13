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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo',['docente','administrativo']);
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('ci')->unique();
            $table->string('fecha_nacimiento');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('profesion');
            $table->timestamps();
            $table->string('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
