<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentsTypes extends Model
{
    protected $table = 'incidents_types';

    protected $fillable = [
        'description',
    ];
}
