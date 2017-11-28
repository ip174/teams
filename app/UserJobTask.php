<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserJobTask extends Model
{
    public $timestamps = false;
	//protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'assigned_by_user', 'title', 'type', 'description', 'created_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
