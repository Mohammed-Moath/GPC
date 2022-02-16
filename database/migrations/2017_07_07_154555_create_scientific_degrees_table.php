<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScientificDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scientific_degrees',50);
            $table->string('name',50);
            $table->string('code',5);
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
        Schema::dropIfExists('scientific_degrees');
    }
}
