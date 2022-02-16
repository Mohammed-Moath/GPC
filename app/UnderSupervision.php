<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnderSupervision extends Model
{
    public $table="under_supervisions";
    protected $fillable = [
        'scientific_degrees_id',
        'program_types_id',
        'Boys',
        'Grilys',
    ];

    public function scientific_degrees(){
        return $this->belongsTo('App\ScientificDegree','scientific_degrees_id');
    }
    public function program_types(){
        return $this->belongsTo('App\ProgramType','program_types_id');
    }
}
