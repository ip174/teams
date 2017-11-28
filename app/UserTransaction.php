<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected $table="user_transactions";
	
	protected $fillable = [
        'user_id',
        'job_id',
        'proposal_id',
        'milestone_id',
        'transaction_id',
        'amount',
        'paymentdate',
        'paid_by',
        'transaction_type',
        'payment_for',
        'payment_status',
        'is_cashout_admin',
        'is_released',
        'payment_gateway_response',
        'is_withdraw_request_received'
    ];
}
