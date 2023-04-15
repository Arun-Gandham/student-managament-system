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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sur_name');
            $table->integer('gender');
            $table->date('dob');
            $table->string('email');
            $table->string('phone');
            $table->string('role')->default(env('STUDENT_ROLE_ID'));
            $table->string('password');
            $table->integer('school_id');
            $table->string('profile_photo', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
