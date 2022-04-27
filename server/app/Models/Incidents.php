<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    protected $table = 'incidents';

    protected $fillable = [
        'title',
        'description',
        'critical_id',
        'type_id',
        'status_id',
    ];
}
