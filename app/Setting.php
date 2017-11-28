<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'admin_name',
        'admin_email',
        'site_title',
        'contact_email',
        'contact_name',
        'contact_phone',
        'site_logo',
        'admin_commission_per_job'
    ];
}
