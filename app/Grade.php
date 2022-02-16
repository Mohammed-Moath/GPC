<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $table="grades";
    protected $fillable = [
        'DegreeOfAttendance',
        'DegreeOfDelivery',
        'DegreeOfSupervisor',
        'DegreeOfMidtermDiscussion',
        'DegreeOfFinalDiscussion',
    ];

}
