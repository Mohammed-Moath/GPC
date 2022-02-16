<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {

            $table->increments('id');
            $table->string('ProgramName',50);
            
            $table->integer('program_types_id')->unsigned();
            $table->foreign('program_types_id')->references('id')->on('program_types');

            $table->integer('scientific_departments_id')->unsigned();
            $table->foreign('scientific_departments_id')->references('id')->on('scientific_departments');

            $table->unsignedSmallInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
