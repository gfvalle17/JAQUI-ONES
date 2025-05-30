<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('paralelos', function (Blueprint $table) {
            $table->foreignId('grado_id')->constrained('grados')->onDelete('cascade')->after('id');
        });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('paralelos', function (Blueprint $table) {
            $table->dropForeign(['grado_id']);
            $table->dropColumn('grado_id');
        });
    }
};

