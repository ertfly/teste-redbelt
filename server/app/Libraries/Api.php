<?php

namespace App\Libraries;

class Api
{
    public static function ok(?array $data)
    {
        return response()->json([
            'response' => [
                'action' => 0,
                'msg' => null,
                'internal' => null,
            ],
            'data' => $data,
        ], 200, ['Access-Control-Allow-Origin' => '*']);
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
        ], 200, ['Access-Control-Allow-Origin' => '*']);
    }
}
