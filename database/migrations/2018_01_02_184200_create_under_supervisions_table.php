<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnderSupervisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('under_supervisions', function (Blueprint $table) {
            $table->increments('id'); 

            $table->integer('scientific_degrees_id')->unsigned();
            $table->foreign('scientific_degrees_id')->references('id')->on('scientific_degrees');

            $table->integer('program_types_id')->unsigned();
            $table->foreign('program_types_id')->references('id')->on('program_types');

            $table->unsignedSmallInteger('Boys');
            $table->unsignedSmallInteger('Grilys');

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
        Schema::dropIfExists('under_supervisions');
    }
}
