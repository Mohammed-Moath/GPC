<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('project_group')->unsigned()->nullable();
            $table->foreign('project_group')->references('id')->on('project_groups');

            $table->text('TitleMeeting');
            $table->text('TaskName');
            $table->unsignedSmallInteger('NumberOfMeeting')->default(0);

            $table->unsignedBigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('FunctionalNumber')->on('project_supervisors');

           // $table->text('ContentMeeting')->nullable();
          
            //$table->text('ContentTasks')->nullable(); // مؤقت
            //$table->boolean('TaskStatu')->nullable()->default(0); // مؤقت

         
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
        Schema::dropIfExists('meetings');
    }
}
