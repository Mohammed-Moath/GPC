<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('Name',100);
            $table->string('username',50)->unique();
            $table->enum('Gender', ['ذكر', 'انثي']);
            $table->string('password',250);
            $table->unsignedBigInteger('PhoneNumber')->nullable();
            $table->string('Email',150)->unique()->nullable();
           
            $table->string('PresonalPicture',100)->nullable();
            $table->rememberToken();

            $table->integer('Roles')->unsigned();
            $table->foreign('Roles')->references('id')->on('user_roles');
           
            $table->boolean('IsActive')->default(1);
            $table->unsignedSmallInteger('status')->default(0);
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
        Schema::dropIfExists('users');
    }
}
