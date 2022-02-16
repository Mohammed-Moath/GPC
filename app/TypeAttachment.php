<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeAttachment extends Model
{
	public $table="type_attachments";
    
    // Associations between Table Type_Attachment and Table Attachment
    public function Attachments(){
        return $this->hasMany('App\Attachment');
    }
}
