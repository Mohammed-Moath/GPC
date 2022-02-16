<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $table="branches";
    protected $fillable = [
        'BrancheNameAR', 'BrancheNameEN','status',
    ];
     
    // Associations between  Table Branchs  and Project_Groups
    public function projectGroups(){
    	return $this->hasMany('App\projectGroup');
    }

    // Associations between Table Project_Students and Table Branchs
    public function ProjectStudents(){
    	return $this->hasMany('App\ProjectStudent');
    }
}
