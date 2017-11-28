<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChatFile extends Model
{
	//protected $table="";
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id', 'file_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}




