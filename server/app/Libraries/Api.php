<?php

namespace App\Libraries;

class Api
{
    public static function ok($data)
    {
        return [
            'response' => [
                'action' => 0,
                'msg' => null,
                'internal' => null,
            ],
            'data' => $data,
        ];
    }

    public static function error($action, $msg, $internal = null)
    {
        return [
            'response' => [
                'action' => $action,
                'msg' => $msg,
                'internal' => $internal,
            ],
            'data' => null,
        ];
    }
}
