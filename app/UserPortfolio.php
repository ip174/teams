<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPortfolio extends Model
{
    use Notifiable;
	public $timestamps = false;
	//protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'portfolio_name', 'uploaded_date', 'description', 'short_desription', 'file_path',
		'file_name', 'portfolio_link', 'number_of_views', 'likes', 'shares', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
