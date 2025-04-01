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
        Schema::create('Student', function (Blueprint $table) {
            $table->string('StudentRegNumber')->primary();
            $table->string('StudentFirstName');
            $table->string('StudentLastName');
            $table->enum('StudentGender', ['Male', 'Female']);
            $table->string('StudentEmail')->unique();
            $table->string('StudentPhoneNumber')->unique();
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
        Schema::dropIfExists('students');
    }
};
