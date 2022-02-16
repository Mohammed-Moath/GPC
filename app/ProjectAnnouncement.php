<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAnnouncement extends Model 
{
	public $table="project_announcements";
    public $timestamps=false;

    // Associations between Table Project_Announcement and Table Attachment
    public function Attachments(){
        return $this->hasMany('App\Attachment');
    }
}
