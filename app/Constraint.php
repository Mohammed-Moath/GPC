<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constraint extends Model
{
    public $table="constraints";
    protected $fillable = [
        /*'AcademicYear',
        'StartSemesterOne',
        'EndSemesterOne',
        'StartSemesterTwo',
        'EndSemesterTwo',*/
        'Number_AddProposalStudent', 
        'Number_AddProposalTeacher',
        'Number_chooseWishes',
        'Min_Number_StudentinGroup', 
        'Max_Number_StudentinGroup',
        'Max_Certified_Project_GroupB',
        'Max_Certified_Project_GroupG',
        //'Max_Supervisor_GroupsB', 
        //'Max_Supervisor_GroupsG',
        
    ];
}
