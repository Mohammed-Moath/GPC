<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('type_attachments_id')->unsigned();
            $table->foreign('type_attachments_id')->references('id')->on('type_attachments');


            $table->string('PathAttachments');

            $table->integer('project_announcements_id')->unsigned();
            $table->foreign('project_announcements_id')->references('id')->on('project_announcements');

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
        Schema::dropIfExists('attachments');
    }
}
