<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TitleAnnouncement',100);
            $table->text('DescirptionAnnouncement')->nullable();
            $table->datetime('DatePublication');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_announcements');
    }
}
