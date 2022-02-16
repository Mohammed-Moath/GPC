<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingProjectStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_project_students', function (Blueprint $table) {
           
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->foreign('meeting_id')->references('id')->on('meetings');

            $table->unsignedBigInteger('AcdameicNumber')->unsigned()->nullable();
            $table->foreign('AcdameicNumber')->references('id')->on('project_students');

            $table->boolean('Aattendance')->nullable();

            //$table->boolean('Presanet')->default(1);
            //$table->boolean('Absent')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_project_students');
    }
}
