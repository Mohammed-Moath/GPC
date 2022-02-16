<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('proposals_id')->unsigned()->nullable();
            $table->foreign('proposals_id')->references('id')->on('proposals');

            $table->unsignedBigInteger('FN_Supervisor')->unsigned()->nullable();
            $table->foreign('FN_Supervisor')->references('id')->on('project_supervisors');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('project_groups');
            
            $table->text('NotesCommittee')->nullable();
            $table->unsignedSmallInteger('status')->default(0);

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
        Schema::dropIfExists('approvals');
    }
}
