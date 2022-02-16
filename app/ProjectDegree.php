<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDegree extends Model
{
	public $table="project_degrees";
    protected $fillable = [
        'Student_AN',
        'Degree_attendance',
        'Degree_delivery',
        'Degree_Supervisor',
        'Degree_Midterm_discussion',
        'Degree_Final_discussion',
        'Aredisplayed',
        ];

    // Associations between Table Project_Students and Table Project_Degrees
    public function project_students(){
        return $this->belongsTo('App\ProjectStudent','Student_AN');
    }

}
