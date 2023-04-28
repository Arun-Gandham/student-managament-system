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
        Schema::create('fee_management', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('fee_type');
            $table->decimal('fee_amount');
            $table->string('fee_due_date');
            $table->string('fee_paid_date');
            $table->integer('fee_status');
            $table->string('fee_description');
            $table->integer('financial_year_id');
            $table->integer('payment_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_management');
    }
};
