<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {

            $table->increments('id');
            $table->string('AcademicYear',10);
            $table->string('Semester', 10);
            $table->string('Name',100)->nullable();
            $table->string('StartDate',100);
            $table->string('EndDate',100);
            $table->string('EndSubmissionProposals',100);
            $table->string('EndCreateGroup',100);
            $table->string('EndChooseWishes',100);
            $table->text('note')->nullable();      
            $table->unsignedSmallInteger('Active')->default('0')->nullable(); // {غير نشط -0 ، نشط -1 ، منتهي -2}
            $table->boolean('Current')->default("0")->nullable(); 

            $table->unsignedBigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

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
        Schema::dropIfExists('calendars');
    }
}
