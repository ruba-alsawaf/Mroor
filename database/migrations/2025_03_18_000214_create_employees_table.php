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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->enum('role', allowed: ['Police', 'CertOfficer', 'ViolationOfficer']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('national_id')->unique()->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('nationality')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            $table->string('access_token', 80)->unique()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
