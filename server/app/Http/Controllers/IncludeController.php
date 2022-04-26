<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller  as BaseController;

class IncludeController extends BaseController
{
    public function header()
    {
        return [
            'pending_request' => 3,
            'pending_messages' => 10,
        ];
    }
}
