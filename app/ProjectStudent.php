<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class ProjectStudent extends Model
{ 
    //use softDeletes;
    public $table="project_students";
    protected $primaryKey = "AcdameicNumber";
    protected $fillable = [
        'AcdameicNumber',
        'calendar_id',
        'HoursCompleted',
        'programs_id',
        'branches_id',
        'Complete_FeldTraining',
        'project_groups_id',
        'Degree_attendance',
        'Degree_delivery',
        'Degree_Supervisor',
        'Degree_Midterm_discussion',
        'Degree_Final_discussion',
        'users_id',];


    // Associations between  Table Project_Students and Project_Groups
    public function project_groups(){
    	return $this->belongsTo('App\projectGroup','project_groups_id');
    }

     // Associations between  Table Project_Students  and Scientific_Projgram
    public function programs(){
    	return $this->belongsTo('App\Program');
    }

    // Associations between Table Project_Students and Table Users
    public function users(){
        return $this->belongsTo('App\User');
    }

    // Associations between Table Project_Students and Table Branchs
    public function branches(){
        return $this->belongsTo('App\Branch');
    }

     // Associations between Table Project_Students and Table Project_Degrees
    public function ProjectDegrees(){
        return $this->hasMany('App\ProjectDegree','Student_AN ','AcdameicNumber');
    }

    //Associations between Table Project_Student and Table meetings
    public function meetings(){
        return $this->belongsToMany('App\Meeting','meeting_project_students','Student_AN','meetings_id');
    }

}
