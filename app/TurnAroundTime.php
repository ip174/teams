<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurnAroundTime extends Model
{
    //protected $table = 'turn_around_times';
	//public $timestamps = false;
	
	protected $fillable = [
        'around_time_type', 'status'
    ];
}
