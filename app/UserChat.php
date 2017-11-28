<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
	//protected $table="";
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'to_user_id', 'job_id', 'message_subject', 'message_content', 'message_dttime'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

	public function toUser(){
		return $this->belongsTo('App\User', 'to_user_id', 'id');
	}

    public function toUserDet(){
        return $this->belongsTo('App\UserDetail', 'to_user_id', 'user_id');
    }
	
	public function fromUser(){
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
    public function fromUserDet(){
        return $this->belongsTo('App\UserDetail', 'user_id', 'user_id');
    }
	
}




