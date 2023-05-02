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
        Schema::create('exams_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('total_marks');
            $table->integer('school_id');
            $table->integer('class_id');
            $table->integer('section_id');
            $table->string('start_data');
            $table->string('end_date');
            $table->date('result_date');
            $table->text('topics');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams_schedules');
    }
};
