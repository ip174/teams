<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HirerSubscription extends Model
{
    public $timestamp = false;
	//protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emailAddress', 'ipaddress'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
