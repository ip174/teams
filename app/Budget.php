<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //protected $table = 'budgets';
	//public $timestamps = false;
	
	protected $fillable = [
        'budget_type', 'status'
    ];
}
