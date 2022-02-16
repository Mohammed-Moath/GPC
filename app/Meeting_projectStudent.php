<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_projectStudent extends Model
{
    public $table="meeting_project_students";
    public $timestamps=false;
    protected $fillable = ['meeting_id','AcdameicNumber'];
}