<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobProposal extends Model
{
    use Notifiable;
	//public $timestamp = false;
	//protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sent_by_user', 'job_id', 'proposal_referance_no', 'description',
		'interview_question_challanges', 'attched_file'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function user(){
		return $this->belongsTo('App\User', 'sent_by_user', 'id');
	}
	
	public function userDet(){
		return $this->belongsTo('App\UserDetail', 'sent_by_user', 'user_id');
	}
}
