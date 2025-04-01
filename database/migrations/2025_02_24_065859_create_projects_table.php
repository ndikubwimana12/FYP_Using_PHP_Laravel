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
        Schema::create('Project', function (Blueprint $table) {
            $table->string('ProjectCode')->primary();
            $table->string('ProjectName');
            $table->text('ProjectProblems');
            $table->text('ProjectSolutions');
            $table->text('ProjectAbstract');
            $table->string('ProjectDissertation');
            $table->string('ProjectSourceCodes');
            $table->string('StudentRegNumber');

            $table->foreign('StudentRegNumber')->references('StudentRegNumber')->on('Student');
           
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
        Schema::dropIfExists('Project');
    }
};
