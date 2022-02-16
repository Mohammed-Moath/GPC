<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCalendar extends Model
{
    public $table="project_calendars";
    protected $fillable = [
        'id',
        'AcademicYear',
        'Semester',
        'SubmissionProposals',
        'Number_AddProposalStudent',
        'Number_AddProposalTeacher',
        'createGroup', 
        'ChooseWishes',
        'Number_chooseWishes',
        'Min_Number_StudentinGroup', 
        'Number_StudentinGroup',
        'Max_Certified_Project_GroupB',
        'Max_Certified_Project_GroupG',
        'Max_Supervisor_GroupsB', 
        'Max_Supervisor_GroupsG',
        
    ];

    // Associations between  Table Project_Calendara and Project_Groups
    public function projectGroups(){
        return $this->hasMany('App\projectGroup');
    }

    // Associations between  Table Project_Calendara and Project
    public function Projects(){
        return $this->hasMany('App\Project');
    }
}
