<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsJob extends Model
{
    //protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'free_credit_to_all', 'urgent_assignment_fee', 'highlight_bid_fee', 'modified_by'
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
