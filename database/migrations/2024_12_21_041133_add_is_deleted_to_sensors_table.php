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
            $table->boolean('is_deleted')->default(false); // Estado de eliminado
        });
    }
    
    public function down()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });
    }
    
};
