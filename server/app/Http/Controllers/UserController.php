<?php

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function list()
    {
        $rows = [];
        foreach (User::all() as $r) {
            $rows[] = [
                'id' => $r->id,
                'name' => $r->name,
                'username' => $r->username,
            ];
        }

        return [
            'rows' => $rows,
        ];
    }
}
