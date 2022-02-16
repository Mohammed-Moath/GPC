<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('DegreeOfAttendance')->default(0);
            $table->unsignedSmallInteger('DegreeOfDelivery')->default(0);
            $table->unsignedSmallInteger('DegreeOfSupervisor')->default(0);
            $table->unsignedSmallInteger('DegreeOfMidtermDiscussion')->default(0);
            $table->unsignedSmallInteger('DegreeOfFinalDiscussion')->default(0);
         
            
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
        Schema::dropIfExists('grades');
    }
}
