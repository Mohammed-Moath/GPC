<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public $table="meetings";
    protected $fillable = [
    'project_group',
    'TitleMeeting',
    'ContentMeeting',
    'TaskName',
    'ContentTasks',
    'TaskStatu',
    'created_by',
    'NumberOfMeeting',
    ];


    // Associations between Table Meeting  and Project_Groups
    public function projectGroup(){
        return $this->belongsTo('App\projectGroup');
    }

    // Associations between Table Meeting  and Meeting_tasks
    public function MeetingTasks(){
        return $this->hasMany('App\MeetingTask');
    }

    //Associations between Table Project_Student and Table meetings

    public function project_students(){
        return $this->belongsToMany('App\ProjectStudent','meeting_project_students','meeting_id','AcdameicNumber');
    }

    public function project_supervisors(){ 
        return $this->belongsTo('App\ProjectSupervisor','created_by');
    }
}
