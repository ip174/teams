<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Postedjobs extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'posted_by_user', 'experience_level', 'project_length', 'location', 
		'turn_around_time', 'budget_type', 'paymentType', 'roundsOfRevisions', 'needs_to_design_job', 'category', 
		'subcategory', 'job_description', 'attached_file', 'have_assesment', 
		'created_at', 'created_ip', 'job_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];
	
	public function turnaroundtime(){
		return $this->belongsTo('App\TurnAroundTime', 'turn_around_time', 'id');
	}
	
	public function user(){
		return $this->belongsTo('App\User', 'posted_by_user', 'id');
	}
	
	public function experienceLevel(){
		return $this->belongsTo('App\ExperienceLevel', 'experience_level', 'level_id');
	}
	
	public function project_length(){
		return $this->belongsTo('App\ProjectLength', 'project_length', 'id');
	}
	
	public function budget(){
		return $this->belongsTo('App\Budget', 'budget_type', 'id');
	}
	
	
}




