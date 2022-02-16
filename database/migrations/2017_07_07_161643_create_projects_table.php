<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ProjectName',100);
            $table->string('SupervisorName',100);
            $table->string('laderName',100);
            $table->text('ProjectDescription');
            $table->string('PathProject_Document',200);
            $table->string('PathProject_Software',200);

            $table->integer('project_calendars_id')->unsigned()->nullable();
            $table->foreign('project_calendars_id')->references('id')->on('project_calendars');

            $table->boolean('IsVeiw');
            $table->unsignedSmallInteger('NumberDownload')->default(0);

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
        Schema::dropIfExists('projects');
    }
}
