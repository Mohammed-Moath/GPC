<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScientificDepartment extends Model
{
	public $table="scientific_departments";
    protected $fillable = ['DepartmentName','status',];
	
    // Associations btwoen Table Scientific_Department and Table scientific_programs
    public function Program(){
        return $this->hasMany('App\Program');
    }
}
