<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectLength extends Model
{
    //protected $table = 'project_lengths';
	//public $timestamps = false;
	
	protected $fillable = [
        'length_type', 'status'
    ];
}
