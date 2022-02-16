<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_groups', function (Blueprint $table) {

            $table->increments('id');
            $table->string('GroupCode',15)->unique();

            $table->unsignedBigInteger('calendar_id')->unsigned()->nullable();
            $table->foreign('calendar_id')->references('id')->on('calendars');
            
            $table->integer('branches_id')->unsigned()->nullable();
            $table->foreign('branches_id')->references('id')->on('branches');

            $table->unsignedBigInteger('GroupLader')->unsigned()->nullable();
            $table->foreign('GroupLader')->references('id')->on('project_students');

            $table->unsignedBigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->string('Number_Team',5)->nullable();

            $table->integer('proposals_id')->unsigned()->nullable();
            $table->foreign('proposals_id')->references('id')->on('proposals');

            $table->unsignedBigInteger('FN_Supervisor')->unsigned()->nullable();
            $table->foreign('FN_Supervisor')->references('id')->on('project_supervisors');

            $table->text('NotesCommittee')->nullable();

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
        Schema::dropIfExists('project_groups');
    }
}
