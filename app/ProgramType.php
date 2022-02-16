<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    protected $table='program_types';
    protected $fillable = [
        'name','status',
    ];
}
