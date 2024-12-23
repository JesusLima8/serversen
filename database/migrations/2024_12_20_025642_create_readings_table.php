<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->constrained()->onDelete('cascade'); // Relación con la tabla de sensores
            $table->float('temperature'); // Temperatura enviada
            $table->float('humidity'); // Humedad enviada
            $table->timestamp('created_at'); // Tiempo del envío
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('readings', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });
    }
};
