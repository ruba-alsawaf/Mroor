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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('situation', 45);
            $table->string('registration_plate', 45)->unique();
            $table->string('color', 45);
            $table->boolean('tinted')->default(false);
            $table->string('type', 45);
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('user_license_id')->nullable();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('user_license_id')->references('id')->on('licenses')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
