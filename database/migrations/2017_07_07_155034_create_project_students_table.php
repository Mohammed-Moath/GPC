<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_students', function (Blueprint $table) {

            $table->unsignedBigInteger('AcdameicNumber')->primary(); 


            $table->unsignedBigInteger('calendar_id')->unsigned()->nullable();
            $table->foreign('calendar_id')->references('id')->on('calendars');
            

            $table->integer('branches_id')->unsigned();
            $table->foreign('branches_id')->references('id')->on('branches');

            $table->integer('programs_id')->unsigned();
            $table->foreign('programs_id')->references('id')->on('programs');

            $table->unsignedSmallInteger('HoursCompleted');
            $table->enum('Complete_FeldTraining', ['Yes', 'No'])->nullable();

            $table->integer('project_groups_id')->unsigned()->nullable();
            $table->foreign('project_groups_id')->references('id')->on('project_groups');

          

            $table->unsignedSmallInteger('Degree_attendance')->default(0);
            $table->unsignedSmallInteger('Degree_delivery')->default(0);
            $table->unsignedSmallInteger('Degree_Supervisor')->default(0);
            $table->unsignedSmallInteger('Degree_Midterm_discussion')->default(0);
            $table->unsignedSmallInteger('Degree_Final_discussion')->default(0);

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
           // $table->boolean('Aredisplayed')->default(1);

            $table->timestamps();
            //$table->softDeletes();


          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_students');
    }
}
