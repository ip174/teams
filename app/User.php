<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username', 'first_name', 'last_name', 'password', 'remember_token',
        'type',
        'phone_number_code', 'phone_number', 'language_id', 'country_id',
        'provider', 'provider_id', 'available_from', 'available_to', 'notificationSoundAlert'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'card_no', 'card_cvv', 'card_exp_month', 'card_exp_year',  'updated_at',
        'profile_picture',
        'facebook_connect', 'facebook_token', 'facebook_access_token',
        'google_connect', 'google_token', 'google_access_token'
    ];

    protected $appends = ['image_url', 'thumb_image_url'];

    public function getImageUrlAttribute()
    {
        if (!empty($this->attributes['profile_picture']))
            return url('uploads/profile_picture/thumbs/' . $this->attributes['profile_picture']);
        else
            return '';
    }

    public function getThumbImageUrlAttribute()
    {
        if (!empty($this->attributes['profile_picture']))
            return url('uploads/profile_picture/thumbs/' . $this->attributes['profile_picture']);
        else
            return '';
    }

    /**
     * Scope a query to only include passengers.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        $type = $type == 'driver' ? 2 : 1;
        return $query->where('type', $type);
    }

    public function passenger()
    {
        return $this->hasOne('App\Passenger','user_id','id');
    }
	
	public function user()
    {
        return $this->hasOne('App\Users','id','id');
    }

    public function userdet()
    {
        return $this->hasOne('App\UserDetail','user_id','id');
    }

    public function SecurityQuestion()
    {
        return $this->hasOne('App\SecurityQuestion', 'id', 'question_id');
    }

    public function driver()
    {
        return $this->hasOne('App\Driver','user_id','id');
    }

    public function customerAddresses()
    {
        return $this->hasMany('App\CustomerAddress','user_id','id');
    }

    public function billingAddress()
    {
        return $this->hasOne('App\CustomerAddress','user_id','id')->where('type', 1);
    }

    public function shippingAddress()
    {
        return $this->hasOne('App\CustomerAddress','user_id','id')->where('type', 2);
    }
}



