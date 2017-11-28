<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProfileView extends Model
{
    //protected $table = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'view_to_user', 'view_by_user', 'weekdays'
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
