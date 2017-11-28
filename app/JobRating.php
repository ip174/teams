<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRating extends Model
{
    //protected $table = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'review_for_user', 'review_by_user', 'rating', 'review_feedback', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
