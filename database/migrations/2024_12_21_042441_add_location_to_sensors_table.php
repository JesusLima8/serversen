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
        Schema::table('sensors', function (Blueprint $table) {
            $table->string('location')->nullable(); // Campo 'location', puede ser opcional
        });
    }
    
    public function down()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropColumn('location'); // Eliminar el campo si se revierte la migración
        });
    }
};
