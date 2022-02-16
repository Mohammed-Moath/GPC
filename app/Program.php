<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table='programs';
    protected $fillable = [
        'ProgramName', 'program_types_id','scientific_departments_id','status',
    ];
    public $timestamps=false;

    // Associations btwoen Table Scientific_Department and Table scientific_programs
    public function scientific_departments(){
        return $this->belongsTo('App\ScientificDepartment','scientific_departments_id');
    }
    public function program_types(){
        return $this->belongsTo('App\ProgramType','program_types_id');
    }

    /*

        // Associations btween Table Project_Supervisor and Table Scientific_Programs
        public function ProjectSupervisors(){
            return $this->hasMany('App\ProjectSupervisor');
        }

        // Associations between Table Project_Students and Table Scientific_Programs
        public function ProjectStudents(){
            return $this->hasMany('App\ProjectStudents');
        }

        //Associations between Table Project_Programs and Table Proposer
        public function proposals(){
            return $this->belongsToMany('App\Proposal','proposal_program','program_id','proposal_id');
        }
    */
}
