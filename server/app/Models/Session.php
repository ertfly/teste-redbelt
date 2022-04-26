<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    protected $table = 'sessions';

    protected $fillable = [
        'token',
        'user_id',
        'access_ip',
        'access_browser',
        'created_at',
        'updated_at',
    ];
}
