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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('student_registration_number');
            $table->string('primary_name');
            $table->string('primary_phone');
            $table->string('primary_alt_phone');
            $table->string('primary_email');
            $table->string('primary_education');
            $table->string('primary_ocupation');
            $table->integer('primary_relation');
            $table->string('secondary_name');
            $table->string('secondary_phone');
            $table->string('secondary_alt_phone');
            $table->string('secondary_email');
            $table->string('secondary_education');
            $table->string('secondary_ocupation');
            $table->integer('secondary_relation');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
