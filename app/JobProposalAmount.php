<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobProposalAmount extends Model
{
    use Notifiable;
	//public $timestamp = false;
	//protected $table = 'job_proposal_amounts';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'sent_by_user', 'proposal_id', 'item_description', 'amount', 'is_paid'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'created_at'
    ];
	
	public function user(){
		return $this->belongsTo('App\User', 'sent_by_user', 'id');
	}
}
