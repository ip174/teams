<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationMaster extends Model
{
	//protected $table = '';
	public $timestamps = false;    

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'details', 'is_active'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
	
	
}




