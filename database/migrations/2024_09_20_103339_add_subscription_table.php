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
        Schema::create('subscription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');//stduent or school
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('plan_id');
            $table->timestamps();
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
