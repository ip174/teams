<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
	//protected $table = '';
	//public $timestamps = false;    

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sent_by_user', 'title', 'short_description', 'full_description', 'notification_link', 'viewed_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}




