<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAssignedMember extends Model
{
    public $timestamps = false;
	//protected $table = '';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'task_id', 'type', 'assigned_by_user', 'assigned_to_member', 'is_completed', 'due_date', 'assigned_date', 'priority'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    
    public function task_details()
    {
        return $this->belongsTo('App\UserJobTask', 'task_id', 'id');
    }

    /*public function task_file()
    {
        return $this->belongsTo('App\TaskAttachment', 'job_id', 'job_id');
    }*/

    public function user_assignedBy()
    {
        return $this->belongsTo('App\User', 'assigned_by_user', 'id');
    }

    public function user_assignedTo()
    {
        return $this->belongsTo('App\User', 'assigned_to_member', 'id');
    }
}
