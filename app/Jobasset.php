<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobasset extends Model
{
    protected $fillable = [
        'name', 'is_file','parent_id', 'mime_type','size','asset_file_path','job_id','user_id','updated_at'
    ];
}
