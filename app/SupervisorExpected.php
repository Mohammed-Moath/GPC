<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorExpected extends Model
{
    protected $table="supervisor_expecteds";
    public $timestamps=false;
    protected $fillable = ['proposal_id','FunctionalNumber'];

    public function project_supervisors(){
        return $this->belongsTo('App\ProjectSupervisor','FunctionalNumber');
    }
    
}
 