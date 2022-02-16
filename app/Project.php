<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	public $table="projects";

    // Associations between  Table Project_Calendara and Project
    public function ProjectCalendar(){
        return $this->belongsTo('App\ProjectCalendar');
    }
}
