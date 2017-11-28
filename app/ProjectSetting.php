<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSetting extends Model
{
	//protected $table = '';
	public $timestamps = false;    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'working_days_from', 'working_days_to', 'working_hours'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}




