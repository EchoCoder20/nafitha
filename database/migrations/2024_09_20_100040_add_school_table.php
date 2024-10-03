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
        Schema::create('school', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('email')->default(null);
            $table->string('phone_number')->default(null);
            $table->unsignedBigInteger('code_id');
            $table->string('school_type')->default('public');
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
