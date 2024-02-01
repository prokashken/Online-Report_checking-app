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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->unique();
            $table->string('patient_name');
            $table->string('patient_passport');
            $table->string('patient_dob');
            $table->string('medical_centre_id');
            $table->string('dicomfile_name')->nullable();
            $table->string('doctor_status')->nullable();
            $table->string('doctor_remarks')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
