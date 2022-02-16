<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    public $table="appointments";
    protected $fillable = [
        'calendar_id',
        'type',
        'name',
        'time_open',
        'time_close',
        'descrdiption',
        'created_by',
    ];

    public function users(){

        return $this->belongsTo('App\User','created_by');
    }

}
