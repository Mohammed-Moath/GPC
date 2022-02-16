<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSupervisor extends Model
{
    protected $table='project_supervisors';
    protected $primaryKey = 'FunctionalNumber';
    protected $fillable = [
        'FunctionalNumber',
        'HoursOfService',
        'scientific_degrees_id',
        'programs_id',
        'users_id',
        'StatuSupervision',
        ];
    
    
    // Associations between Table Project_Supervisor and Table Scientific_Degrees
    public function scientific_degrees(){
        return $this->belongsTo('App\ScientificDegree','scientific_degrees_id');
    }
    public function proposals(){
        return $this->belongsToMany('App\Proposal_Project_supervisor','proposal__project_supervisors','FunctionalNumber','proposal_id');
    }
    // Associations between Table Project_Supervisor and Table Scientific_Programs
    public function programs(){
        return $this->belongsTo('App\Program');
    }

    // Associations between Table Project_Supervisor and Table Users
    public function users(){
        return $this->belongsTo('App\User');
    }

    // Associations between Table Project_Supervisor and Table Project_groups
    public function project_groups(){
        return $this->hasMany('App\projectGroup','FN_Supervisor');
    }
}
