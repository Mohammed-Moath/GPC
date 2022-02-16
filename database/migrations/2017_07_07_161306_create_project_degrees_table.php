<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_degrees', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedBigInteger('Student_AN')->unsigned();
            $table->foreign('Student_AN')->references('id')->on('project_students');

            $table->unsignedSmallInteger('Degree_attendance')->default(0);
            $table->unsignedSmallInteger('Degree_delivery')->default(0);
            $table->unsignedSmallInteger('Degree_Supervisor')->default(0);
            $table->unsignedSmallInteger('Degree_Midterm_discussion')->default(0);
            $table->unsignedSmallInteger('Degree_Final_discussion')->default(0);
            $table->boolean('Aredisplayed')->default(1);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_degrees');
    }
}
