<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Libraries\Strings;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Lumen\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function submit()
    {
        $username = Input::json('username', 'Nome do usuário', [FormValidation::REQUIRED]);
        $pass = Input::json('pass', 'Senha', [FormValidation::REQUIRED]);

        $user = User::where('username', $username)->first();
        if (!$user) {
            throw new ApiHandler('Usuário ou senha inválidos!');
        }

        if (Strings::password($pass) != $user->pass) {
            throw new ApiHandler('Usuário ou senha inválidos!');
        }

        $sid = Session::where('token', request()->header('token'))->first();
        $sid->user_id = $user->id;
        $sid->updated_at = Carbon::now();
        $sid->save();

        return [
            'name' => $sid->user_id ? $user->name : '',
            'token' => $sid->token,
            'logged' => intval($sid->isLogged()),
        ];
    }

    public function delete()
    {
        $sid = Session::where('token', request()->header('token'))->first();
        $sid->user_id = null;
        $sid->updated_at = Carbon::now();
        $sid->save();
        return [];
    }
}
