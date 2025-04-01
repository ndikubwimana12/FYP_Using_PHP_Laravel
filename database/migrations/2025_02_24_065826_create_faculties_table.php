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
        Schema::create('Faculity', function (Blueprint $table) {
            $table->string('FacultyCode')->primary();
            $table->string('FacultyName');
            $table->string('DepartmentCode');
            $table->foreign('DepartmentCode')->references('DepartmentCode')->on('Department');
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
        Schema::dropIfExists('Faculity');
    }
};
