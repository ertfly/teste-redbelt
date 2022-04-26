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
            $app = Input::json('app', 'app', [FormValidation::REQUIRED]);
            $version = Input::json('version', 'version', [FormValidation::REQUIRED]);
            $createdAt = date('Y-m-d H:i:s');
            $token = Strings::token();

            $session = new Session([
                'token' => $token,
                'app' => $app,
                'version' => $version,
                'created_at' => $createdAt,
            ]);

            $session->save();
            return [
                'token' => $token,
            ];
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage(), ApiHandler::NONE);
        }
    }
}
