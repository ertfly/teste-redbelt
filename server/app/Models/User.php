<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';
    const GENDER_INDIFFERENT = 'I';

    protected $fillable = [
        'fullname',
        'email',
        'pass',
        'username',
        'phone',
        'gender',
        'birth',
        'photo',
        'provider_id',
    ];
}
