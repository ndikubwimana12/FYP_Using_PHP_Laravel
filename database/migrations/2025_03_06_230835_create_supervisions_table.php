<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supervisor_id')
                ->constrained('Supervisor'); // Changed from 'supervisors' to 'Supervisor'
            $table->string('StudentRegNumber');
            $table->foreign('StudentRegNumber')
                ->references('StudentRegNumber')
                ->on('Student')
                ->onDelete('cascade');
            $table->enum('status', ['active', 'completed', 'terminated']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supervisions');
    }
};
