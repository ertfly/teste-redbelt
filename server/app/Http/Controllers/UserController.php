<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Libraries\Strings;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
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

    public function create()
    {
        $name = Input::json('name', 'Nome', [FormValidation::REQUIRED]);
        $username = Input::json('username', 'Nome de usuário', [FormValidation::REQUIRED]);
        $pass = Input::json('pass', 'Senha', [FormValidation::REQUIRED]);
        $passConfirm = Input::json('passConfirm', 'Confirmação de senha', [FormValidation::REQUIRED]);

        if (Strings::password($pass) != Strings::password($passConfirm)) {
            throw new Exception('Confirmação de senha inválida!');
        }

        $check = User::where('username', $username)->first();
        if ($check && $check->id) {
            throw new ApiHandler('Nome de usuário já esta sendo usado em outra conta');
        }

        $user = new User([
            'name' => $name,
            'username' => $username,
            'pass' => Strings::password($pass),
        ]);
        $user->save();

        return [];
    }

    public function update($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            throw new Exception('Registro não encontrado!');
        }

        $name = Input::json('name', 'Nome', [FormValidation::REQUIRED]);
        $username = Input::json('username', 'Nome de usuário', [FormValidation::REQUIRED]);
        $pass = Input::json('pass');
        $passConfirm = Input::json('passConfirm');

        if ($pass && $passConfirm) {
            if (Strings::password($pass) != Strings::password($passConfirm)) {
                throw new Exception('Confirmação de senha inválida!');
            }
            $user->pass = Strings::password($pass);
        }

        $check = User::where('username', $username)->first();
        if ($check && $check->id != $user->id) {
            throw new ApiHandler('Nome de usuário já esta sendo usado em outra conta');
        }

        $user->name = $name;
        $user->username = $username;
        $user->save();

        return [];
    }

    public function delete($id){
        $user = User::where('id', $id)->first();
        if (!$user) {
            throw new Exception('Registro não encontrado!');
        }

        
    }
}
