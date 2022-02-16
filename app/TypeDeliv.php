<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDeliv extends Model
{
    public $table="type_delivs";
    protected $fillable = [
        'id',
        'calendar_id',
        'name',
        'time_open',
        'time_close',
        'descrdiption',
        'created_by',
    ];

    // Associations between Table Deliveries  and Type_Deliveries
    public function Delivs(){
        return $this->hasMany('App\Deliv');
    }

    public function calendars(){
        return $this->belongsTo('App\Calendar','calendar_id');
    }
}
