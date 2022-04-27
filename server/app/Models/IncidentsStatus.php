<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentsStatus extends Model
{
    protected $table = 'incidents_status';

    protected $fillable = [
        'description',
    ];
}
