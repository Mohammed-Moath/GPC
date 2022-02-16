<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_calendars', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('AcademicYear',10);
            $table->string('Semester', 10);
            $table->string('SubmissionProposals',100);
            $table->unsignedSmallInteger('Number_AddProposalStudent'); 
            $table->unsignedSmallInteger('Number_AddProposalTeacher');
            $table->string('createGroup',100);
            $table->string('ChooseWishes',100);
            $table->unsignedSmallInteger('Number_chooseWishes');
            $table->unsignedSmallInteger('Number_StudentinGroup');
            $table->unsignedSmallInteger('Min_Number_StudentinGroup');
            $table->unsignedSmallInteger('Max_Certified_Project_GroupB');
            $table->unsignedSmallInteger('Max_Certified_Project_GroupG');
            $table->unsignedSmallInteger('Max_Supervisor_GroupsB');
            $table->unsignedSmallInteger('Max_Supervisor_GroupsG');


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
        Schema::dropIfExists('project_calendars');
    }
}
