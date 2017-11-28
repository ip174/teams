<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserDetail extends Model
{
    use Notifiable;
	public $timestamps = false;
	//protected $table = 'user_details';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'availability_status', 'rate_per_hour', 'location', 'travel_distance', 'job_type',
		'website', 'sample_video', 'focus', 'field_of_work', 'about', 'linkedin_profile', 'vimeo_profile',
		'twitter_profile', 'behance_profile'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
	
	public function travelType()
    {
        return $this->belongsTo('App\TravelType', 'travel_distance', 'travel_id');
    }
	
	public function focusType()
    {
        return $this->belongsTo('App\FocusType', 'focus', 'focus_type_id');
    }
	
	public function fieldOfWorkType()
    {
        return $this->belongsTo('App\WorkFields', 'field_of_work', 'type_id');
    }
	
	public function jobType()
    {
        return $this->belongsTo('App\JobType', 'job_type', 'job_type_id');
    }
}
