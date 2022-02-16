<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorExpectedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_expecteds', function (Blueprint $table) {
       
            $table->integer('proposal_id')->unsigned()->nullable();
            $table->foreign('proposal_id')->references('id')->on('proposals');

            $table->unsignedBigInteger('FunctionalNumber')->unsigned()->nullable();
            $table->foreign('FunctionalNumber')->references('id')->on('project_supervisors');

   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor_expecteds');
    }
}
