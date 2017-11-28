<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNdaSetting extends Model
{
    public $timestamps = false;
	//protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ndaName', 'ndaCompanyNo', 'ndaVatReg', 'ndaAddress', 'ndaSignature', 'ndaSecurity'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
