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
        //
        Schame::table('code', function (Blueprint $table) {
            
            $table->foreign('school_id')->references('id')->on('school');
           
        });
        Schame::table('code', function (Blueprint $table) {
            
            $table->foreign('school_id')->references('id')->on('school');
           
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
