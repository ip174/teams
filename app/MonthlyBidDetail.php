<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyBidDetail extends Model
{
	//protected $table = '';
	//public $timestamps = false;    

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'job_id', 'proposal_id', 'bid_debited_credit_amount', 'type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	
}




