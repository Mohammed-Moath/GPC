<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateproposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) { 

            $table->increments('id');

            $table->unsignedBigInteger('calendar_id')->unsigned()->nullable();
            $table->foreign('calendar_id')->references('id')->on('calendars');

            $table->string('ProjectProposalTitle',150);
            $table->text('descrdiption');
            $table->text('scope')->nullable(); 
            $table->text('Outputs')->nullable();
            $table->text('ImportanceProposal')->nullable();
            $table->text('Tools')->nullable();
            $table->unsignedSmallInteger('NumberOfStudents')->nullable();
            $table->enum('PropertyRight', ['1', '2', '3', '4','5'])->nullable();

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');

            //this is  Write by GPC
            $table->boolean('References')->nullable()->default(0);
            $table->boolean('Certified')->nullable()->default(0);
            $table->unsignedSmallInteger('Selected')->default(0);

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
        Schema::dropIfExists('proposals');
    }
}
