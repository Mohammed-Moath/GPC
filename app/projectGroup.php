<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectGroup extends Model
{
    protected $table='project_groups';
    protected $fillable = [
    'GroupCode',
    'calendar_id',
    'branches_id',
    'GroupLader',
    'created_by', 
    'Number_Team',
    'proposals_id',
    'FN_Supervisor',
    'NotesCommittee',
    ];

    // Associations between table proposl and calendar
    public function calendars(){
        return $this->belongsTo('App\Calendar','calendar_id');
    }

    // Associations between Table Branchs and Project_Groups
    public function branches(){
        return $this->belongsTo('App\Branch');
    }
    public function GroupWishe(){
        return $this->hasMany('App\GroupWishe','groups_id');
    }
    

    // Associations between Table Project_Proposals and Project_Groups
    public function proposals(){
        return $this->belongsTo('App\Proposal');
    }

    // Associations between Table Project_Students and Project_Groups
    public function project_students(){
        return $this->belongsTo('App\ProjectStudent','GroupLader');
    }

    public function ProjectStudent(){
        return $this->hasMany('App\ProjectStudent','project_groups_id');
    }

    public function project_supervisors(){ 
        return $this->belongsTo('App\ProjectSupervisor','FN_Supervisor');
    }
       
    // Associations between Table Meeting and Project_Groups
    public function Meetings(){
        return $this->hasMany('App\Meeting','project_group');
    }

    // Associations between Table Deliveries and Project_Groups
    public function delivs(){
        return $this->hasMany('App\Deliv','group_id');
    }

    public function users(){

        return $this->belongsTo('App\User','created_by');
    }
}
