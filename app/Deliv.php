<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliv extends Model
{
    public $table="delivs";
    protected $fillable = [
        'group_id',
        'type_delivs',
        'created_by',
        'statu',
        'Note',
        'path',
    ];

    // Associations between Table Deliveries  and Type_Deliveries
    public function type_delivs(){
        return $this->belongsTo('App\TypeDeliv','type_deliv' );
    }

    public function project_students(){
        return $this->belongsTo('App\ProjectStudent','created_by');
    }

    // Associations between Table Deliveries  and project_Groups
    public function project_groups(){
        return $this->belongsTo('App\projectGroup');
    }
}
