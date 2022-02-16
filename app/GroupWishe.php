<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupWishe extends Model
{
    protected $table="group_wishes";
    protected $fillable = ['groups_id','proposals_id','priority','status'];

    public function project_groups(){
    	return $this->belongsTo('App\projectGroup','groups_id');
    }

    public function proposals(){
        return $this->belongsTo('App\Proposal');
    }
}
