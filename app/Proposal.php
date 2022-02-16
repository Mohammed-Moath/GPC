<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    public $table="proposals";
    protected $fillable = [
    'calendar_id',
    'ProjectProposalTitle',
    'descrdiption',
    'scope',
    'Outputs',
    'ImportanceProposal',
    'Tools',
    'NumberOfStudents',
    'PropertyRight',
    'users_id',
    'References',
    'Certified',
    'Selected',
    
    ];
    //public $timestamps=false;
    // Associations between table proposl and calendar
    public function calendars(){
        return $this->belongsTo('App\Calendar','calendar_id');
    }
    //Associations between Table Project_Programs and Table Proposer with anter medel table
    public function programs(){
        return $this->belongsToMany('App\Program','proposal_program');
    }

    public function supervisor_expecteds(){
        return $this->hasMany('App\SupervisorExpected','proposal_id');
    }
    /*// Associations between Table Project_Supervisor and Table Project_Proposals
    public function project_supervisors(){
        return $this->belongsTo('App\ProjectSupervisor','FN_Supervisor');
    }*/

    // Associations between Table Project_Proposals and Project_Groups and Project_Groups
    public function projectGroups(){
    	return $this->hasMany('App\projectGroup');
    }

   


    //Associations between Table Users and Table Proposer
    public function users(){
        return $this->belongsTo('App\User');
    }
}
