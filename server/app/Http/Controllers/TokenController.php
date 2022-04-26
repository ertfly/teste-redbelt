<?php

namespace App\Http\Controllers;

use App\Libraries\Strings;
use App\Models\Session;
use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class TokenController extends BaseController
{
    public function create()
    {
        $accessIp = request()->ip();
        $accessBrowser = request()->userAgent();
        $createdAt = date('Y-m-d H:i:s');
        $token = Strings::token();

        $session = new Session([
            'token' => $token,
            'access_ip' => $accessIp,
            'access_browser' => $accessBrowser,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);
        $session->save();

        return [
            'name' => '',
            'token' => $token,
            'logged' => 0,
        ];
    }

    public function detail()
    {

        $sid = Session::where('token', request()->header('token'))->first();
        $user = User::where('id', $sid->user_id)->first();

        return [
            'name' => $sid->user_id ? $user->name : '',
            'token' => $sid->token,
            'logged' => intval($sid->isLogged()),
        ];
    }
}
