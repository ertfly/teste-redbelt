<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    //providers
    const GOOGLE = 1;
    const FACEBOOK = 2;

    protected $table = 'providers';

    protected $fillable = [
        'id',
        'name',
        'trash',
    ];
}
