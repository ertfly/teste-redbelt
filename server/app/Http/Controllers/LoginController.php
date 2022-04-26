<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Libraries\Strings;
use App\Models\Provider;
use App\Models\Session;
use App\Models\User;
use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function check()
    {
        $sid = request()->sid;

        return [
            'logged' => $sid->user_id ? true : false,
        ];
    }

    public function provider()
    {
        $email = null;
        $providerId = null;

        $email = Input::json('email', 'email', [FormValidation::REQUIRED, FormValidation::EMAIL]);
        $providerId = Input::json('provider_id', 'provider_id', [FormValidation::REQUIRED, FormValidation::NUMERIC]);
        $providerId = intval($providerId);

        if (!in_array($providerId, [Provider::GOOGLE, Provider::FACEBOOK])) {
            throw new Exception('provider_id inválido');
        }

        $sid = request()->sid;

        $user = User::where('email', $email)->first();
        if (!$user) {
            $sid->addItem('register.provider_id', $providerId);
            $sid->save();
            return [
                'is_new' => true,
            ];
        }

        $sid->user_id = $user->id;
        $sid->save();

        return [
            'is_new' => false,
        ];
    }

    public function login()
    {
        try {
            $id = Input::json('id', 'id', [FormValidation::REQUIRED]);
            $pass = Input::json('pass', 'pass', [FormValidation::REQUIRED]);
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        $user = User::where('email', $id)->first();
        if (!$user) {
            $phone = Strings::onlyNumber($id);
            $user = User::where('phone', $phone)->first();
            if (!$user) {
                $user = User::where('username', $id)->first();
            }
        }

        if (!$user) {
            throw new ApiHandler('Usuário ou senha inválidos!');
        }

        if (Strings::password($pass) != $user->pass) {
            throw new ApiHandler('Usuário ou senha inválidos!');
        }

        $sid = request()->sid;
        $sid->user_id = $user->id;
        $sid->save();
    }

    public function recover()
    {
        try {
            $id = Input::json('id', 'id', [FormValidation::REQUIRED]);
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        $user = User::where('email', $id)->first();
        if (!$user) {
            $phone = Strings::onlyNumber($id);
            $user = User::where('phone', $phone)->first();
            if (!$user) {
                $user = User::where('username', $id)->first();
            }
        }

        if (!$user) {
            throw new ApiHandler('Usuário inválido!');
        }

        return [
            'msg' => 'Foi enviado um email para "' . $user->email . '" com sua nova senha!',
        ];
    }
}
