<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre del sensor
            $table->boolean('is_visible')->default(false); // Determina si el sensor es visible para los usuarios
           // $table->string('location')->after('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensors');
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
};
