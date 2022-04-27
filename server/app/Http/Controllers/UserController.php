<?php

use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function list()
    {
        $rows = [];
        
        return [
            'rows' => $rows,
        ];
    }
}
