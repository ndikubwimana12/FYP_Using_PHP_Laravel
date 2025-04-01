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
        Schema::create('Supervisor', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key, replaces supervisor_id
            $table->string('SupervisorEmail');
            $table->string('SupervisorFirstName');
            $table->string('SupervisorLastName');
            $table->string('SupervisorPhoneNumber');
            $table->string('DepartmentCode');
            $table->foreign('DepartmentCode')->references('DepartmentCode')->on('Department')->onDelete('cascade'); // Add onDelete() if needed
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
        Schema::dropIfExists('Supervisor');
    }
};
