<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public $table="attachments";

    // Associations between Table Type_Attachment and Table Attachment
    public function TypeAttachment(){
        return $this->belongsTo('App\TypeAttachment');
    }

    // Associations between Table Project_Announcement and Table Attachment
    public function ProjectAnnouncement(){
        return $this->belongsTo('App\ProjectAnnouncement');
    }
}
