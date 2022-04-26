<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    //variables
    const TERMS_OF_USE = 'TERMS_OF_USE';
    const PRIVACY_POLICY = 'PRIVACY_POLICY';

    protected $table = 'configurations';

    protected $fillable = [
        'id',
        'value',
        'description',
    ];
}
