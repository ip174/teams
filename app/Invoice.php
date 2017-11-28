<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

	//protected $table = '';
	public $timestamps = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_for_user', 'invoice_by_user', 'invoice_date', 'invoice_no', 'why_raising_invoice', 'description', 'status', 'gross_amt', 'fee_amt', 'vat_percent', 'job_id', 'proposal_id', 'milestone_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
       
    ];
	
	
}
