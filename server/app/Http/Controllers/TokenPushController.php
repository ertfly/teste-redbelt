<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Models\Session;
use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class TokenPushController extends BaseController
{
    public function change()
    {
        try {
            $token = request()->header('token');
            if (trim($token) == '') {
                throw new Exception('Informar o "token" no header');
            }

            $session = Session::where('token', $token)->first();
            if (!$session) {
                throw new Exception('"token" inválido');
            }

            $tokenPush = Input::json('token_push');
            if ($tokenPush) {
                $session->token_push = $tokenPush;
                $session->save();
            }

            return [];
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage(), ApiHandler::NONE);
        }
    }
}
