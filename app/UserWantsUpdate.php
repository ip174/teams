<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWantsUpdate extends Model
{
	//protected $table = '';
	public $timestamps = false;    

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'update_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
	
	
}




