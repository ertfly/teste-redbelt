<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentsCritics extends Model
{
    protected $table = 'incidents_critics';

    protected $fillable = [
        'description',
    ];
}
