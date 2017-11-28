<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobBidCreditList extends Model
{
    //public $timestamps = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'credit_limit', 'amount', 'status'
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
