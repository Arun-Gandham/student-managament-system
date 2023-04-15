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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->unique();
            $table->string('school_description');
            $table->string('school_started_on');
            $table->binary('school_image');
            $table->string('school_land_line');
            $table->string('school_phone1');
            $table->string('school_phone2');
            $table->string('school_address1');
            $table->string('school_address2');
            $table->string('school_street');
            $table->string('school_city');
            $table->string('school_district');
            $table->string('school_state');
            $table->string('school_pincode');
            $table->string('school_meta_title');
            $table->string('school_status')->default(1);
            $table->string('school_short_name');
            $table->string('school_short_description');
            $table->string('school_subscription')->default(1);
            $table->binary('school_favicon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
