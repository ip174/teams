<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobproviderTransaction extends Model
{
    protected $table="jobprovider_transactions";
	
	protected $fillable = [
        'user_id',
        'transaction_no',
        'job_id',
        'proposal_id'
    ];
}
