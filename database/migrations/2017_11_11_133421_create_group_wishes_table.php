<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupWishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_wishes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('groups_id')->unsigned()->default(0);
            $table->foreign('groups_id')->references('id')->on('project_groups');

            $table->integer('proposals_id')->unsigned()->default(0);
            $table->foreign('proposals_id')->references('id')->on('proposals');

            $table->unsignedSmallInteger('priority')->nullable();
            $table->unsignedSmallInteger('status')->default(0);
            //$table->boolean('Certified')->nullable()->default(0);

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
        Schema::dropIfExists('group_wishes');
    }
}
