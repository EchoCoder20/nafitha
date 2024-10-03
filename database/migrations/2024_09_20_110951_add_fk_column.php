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
        Schema::table('users', function (Blueprint $table) {
            
            $table->foreign('school_id')->references('id')->on('school');
            $table->foreign('code_id')->references('id')->on('code');
           
        });
        Schema::table('school', function (Blueprint $table) {
            
            $table->foreign('code_id')->references('id')->on('code');
           
        });
        Schema::table('subscription', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('school_id')->references('id')->on('school');
            $table->foreign('plan_id')->references('id')->on('plan');
           
        });
        Schema::table('payment', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('school_id')->references('id')->on('school');
           
           
        });
        Schema::table('questions', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
           
           
           
        });
        Schema::table('result', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
           
           
           
        });
        Schema::table('marks', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');        
           
        });
        Schema::table('option', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');        
           
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
