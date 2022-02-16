<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal_Program extends Model
{
    protected $table="proposal_program";
    public $timestamps=false;
    protected $fillable = ['id','proposal_id','program_id'];
}
