<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelivsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('project_groups');

            $table->integer('type_deliv')->unsigned()->nullable();
            $table->foreign('type_deliv')->references('id')->on('type_delivs');

            $table->unsignedBigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('project_students');

            $table->unsignedSmallInteger('statu')->default(0);
            $table->text('Note')->nullable();
            $table->string('path',300);
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
        Schema::dropIfExists('delivs');
    }
}
