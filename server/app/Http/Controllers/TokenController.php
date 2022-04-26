<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Libraries\Strings;
use App\Models\Session;
use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

class TokenController extends BaseController
{
    public function create()
    {
        try {
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
                'token' => $token,
                'logged' => false,
            ];
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage(), ApiHandler::NONE);
        }
    }
}
