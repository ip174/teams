<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGeneralSetting extends Model
{
	//protected $table = '';
	public $timestamps = false;    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'available_from', 'available_to', 'security_question', 'security_answer', 'account_active', 'last_updated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}




