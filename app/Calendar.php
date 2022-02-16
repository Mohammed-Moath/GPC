<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public $table="calendars";
    protected $fillable = [
        'AcademicYear',
        'Semester',
        'Name',
        'StartDate',
        'EndDate',
        'EndSubmissionProposals', 
        'EndCreateGroup',
        'EndChooseWishes', 
        'note',
        'Active', 
        'Current',
        'created_by',
        
    ];

    public function appointments(){ // Retrieve all deliveries associated with the table
        return $this->hasMany('App\Appointments','calendar_id');
    }

    public function users(){

        return $this->belongsTo('App\User','created_by');
    }

    
}
