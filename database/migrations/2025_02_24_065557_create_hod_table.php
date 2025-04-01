<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hod', function (Blueprint $table) {
            $table->string('Hod_id')->primary();
            $table->string('FirstName');
            $table->string('LastName');
            $table->enum('Gender', ['Male', 'Female']);
            $table->string('Email')->unique();
            $table->string('PhoneNumber')->unique();
            $table->string('password');
            $table->string('DepartmentCode');
            $table->foreign('DepartmentCode')->references('DepartmentCode')->on('Department');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hod');
    }
};
