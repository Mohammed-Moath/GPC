<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    public $table="approvals";
    protected $fillable = [
        'proposals_id', 'FN_Supervisor','group_id','NotesCommittee','status'
    ];

    public function project_groups(){
    	return $this->belongsTo('App\projectGroup','group_id');
    }

    public function proposals(){
        return $this->belongsTo('App\Proposal','proposals_id');
    }

    public function project_supervisors(){ 
        return $this->belongsTo('App\ProjectSupervisor','FN_Supervisor');
    }
}
