<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScientificDegree extends Model
{
    public $table="scientific_degrees";
    protected $fillable = [
        'scientific_degrees', 'name','code','status',
    ];
	
    // Associations btween Table Project_Supervisor and Table Scientific_Degrees
    public function ProjectSupervisors(){
        return $this->hasMany('App\ProjectSupervisor');
    }
}
