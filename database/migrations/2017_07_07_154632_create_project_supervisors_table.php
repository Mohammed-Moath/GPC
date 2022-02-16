<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_supervisors', function (Blueprint $table) {
            
            $table->unsignedBigInteger('FunctionalNumber')->primary();

            $table->integer('scientific_degrees_id')->unsigned()->nullable();
            $table->foreign('scientific_degrees_id')->references('id')->on('scientific_degrees');

            $table->integer('programs_id')->unsigned()->nullable();
            $table->foreign('programs_id')->references('id')->on('programs');

            $table->integer('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');

            $table->boolean('StatuSupervision')->default(1);
            
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
        Schema::dropIfExists('project_supervisors');
    }
}
