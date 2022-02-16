<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstraintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constraints', function (Blueprint $table) {
            $table->increments('id');
            /*$table->string('AcademicYear',10);
            $table->string('StartSemesterOne',100);
            $table->string('EndSemesterOne',100);
            $table->string('StartSemesterTwo',100);
            $table->string('EndSemesterTwo',100);*/
            $table->unsignedSmallInteger('Number_AddProposalStudent'); 
            $table->unsignedSmallInteger('Number_AddProposalTeacher');
            $table->unsignedSmallInteger('Number_chooseWishes');
            $table->unsignedSmallInteger('Max_Number_StudentinGroup');
            $table->unsignedSmallInteger('Min_Number_StudentinGroup');
            $table->unsignedSmallInteger('Max_Certified_Project_GroupB');
            $table->unsignedSmallInteger('Max_Certified_Project_GroupG');
            //$table->unsignedSmallInteger('Max_Supervisor_GroupsB');
            //$table->unsignedSmallInteger('Max_Supervisor_GroupsG');


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
        Schema::dropIfExists('constraints');
    }
}
