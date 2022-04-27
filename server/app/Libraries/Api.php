<?php

namespace App\Libraries;

class Api
{
    private static $headers = [
        /* 'Access-Control-Allow-Origin'      => '*',
        'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age'           => '86400',
        'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, token' */
    ];

    public static function ok(?array $data)
    {
        return response()->json([
            'response' => [
                'action' => 0,
                'msg' => null,
                'internal' => null,
            ],
            'data' => $data,
        ], 200, self::$headers);
    }

    public static function error($action, $msg, $internal = null)
    {
        return response()->json([
            'response' => [
                'action' => $action,
                'msg' => $msg,
                'internal' => $internal,
            ],
            'data' => null,
        ], 200, self::$headers);
    }
}
