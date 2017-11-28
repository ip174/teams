<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienceLevel extends Model
{
    protected $table = 'experience_levels';
	public $timestamps = false;
	
	protected $fillable = [
        'experience_type', 'status'
    ];
}
