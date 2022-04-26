<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Libraries\Strings;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;
use Mockery\CountValidator\Exact;

class RegisterController extends BaseController
{
    public function step1()
    {
        $phone = Input::json('phone', 'Número do celular', [FormValidation::REQUIRED]);
        $phone = Strings::onlyNumber($phone);
        $email = Input::json('email', 'E-mail', [FormValidation::REQUIRED, FormValidation::EMAIL]);

        $user = User::where('phone', $phone)->first();
        if ($user) {
            throw new ApiHandler('Já foi registrado em outra conta com o "Número do celular" informado');
        }

        $user = User::where('email', $email)->first();
        if ($user) {
            throw new ApiHandler('Já foi registrado em outra conta com o "E-mail" informado');
        }
        $sid = request()->sid;
        $sid->addItem('register.email', $email);
        $sid->addItem('register.phone', $phone);
        $sid->addItem('register.smsCode', '0000');
        $sid->save();
    }

    public function step2()
    {
        $smsCode = null;
        try {
            $smsCode = Input::json('code', 'Código', [FormValidation::REQUIRED, FormValidation::NUMERIC]);
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        $sid = request()->sid;

        if ($smsCode != $sid->getItem('register.smsCode')) {
            throw new ApiHandler('Código informado é inválido!');
        }

        $sid->rmItem('register.smsCode');
        $sid->save();
    }

    public function step3()
    {
        $fullname = null;
        $username = null;
        $gender = null;
        $pass = null;
        try {
            $fullname = Input::json('fullname', 'Nome completo', [FormValidation::REQUIRED, FormValidation::STR_LEN_MAX], ['size_max' => 250]);
            $username = Input::json('username', 'Nome de usuário', [FormValidation::REQUIRED], ['size_max' => 30]);
            $gender = Input::json('gender', 'Gênero', [FormValidation::REQUIRED], ['size_max' => 1]);
            $pass = Input::json('pass', 'Senha', [FormValidation::REQUIRED]);
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        if (!in_array($gender, [User::GENDER_MALE, User::GENDER_FEMALE, User::GENDER_INDIFFERENT])) {
            throw new ApiHandler('Gênero inválido!');
        }

        $sid = request()->sid;
        $sid->addItem('register.fullname', $fullname);
        $sid->addItem('register.username', $username);
        $sid->addItem('register.gender', $gender);
        $sid->addItem('register.pass', Strings::password($pass));
        $sid->save();
    }

    public function step4()
    {
        $birth = null;
        try {
            $birth = Input::json('birth', 'Data do seu nascimento', [FormValidation::REQUIRED, FormValidation::DATE], ['format' => 'Y-m-d']);
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        $sid = request()->sid;

        new FormValidation($sid->getItem('register.phone'), 'Número do celular', [FormValidation::REQUIRED]);
        new FormValidation($sid->getItem('register.email'), 'E-mail', [FormValidation::REQUIRED, FormValidation::EMAIL]);
        new FormValidation($sid->getItem('register.fullname'), 'Nome completo', [FormValidation::REQUIRED, FormValidation::STR_LEN_MAX], ['size_max' => 250]);
        new FormValidation($sid->getItem('register.username'), 'Nome de usuário', [FormValidation::REQUIRED], ['size_max' => 30]);
        new FormValidation($sid->getItem('register.gender'), 'Gênero', [FormValidation::REQUIRED], ['size_max' => 1]);
        new FormValidation($sid->getItem('register.pass'), 'Senha', [FormValidation::REQUIRED]);

        $user = new User([
            'fullname' => $sid->getItem('register.fullname'),
            'email' => $sid->getItem('register.email'),
            'pass' => $sid->getItem('register.pass'),
            'username' => $sid->getItem('register.username'),
            'phone' => $sid->getItem('register.phone'),
            'gender' => $sid->getItem('register.gender'),
            'birth' => $birth,
            'provider_id' => $sid->getItem('register.provider_id'),
        ]);
        $user->save();

        $sid->user_id = $user->id;
        $sid->save();
    }

    public function step5()
    {
        $sid = request()->sid;
        if (!$sid->user_id) {
            throw new Exception('Este endpoint necessita estar logado');
        }

        $file = Input::json('file', 'file', [FormValidation::REQUIRED]);

        $file = Strings::base64ToFile($file, ['image/png', 'image/jpg', 'image/jpeg'], 'Foto inválida');
        Storage::disk('public')->put('uploads/users/' . $file['filename'], $file['content']);

        $user = User::where('id', $sid->user_id)->first();
        if (Storage::disk('public')->exists('uploads/users/' . $user->photo)) {
            Storage::disk('public')->delete('uploads/users/' . $user->photo);
        }
        $user->photo = $file['filename'];
        $user->save();

        return [
            'photo' => env('APP_URL') . Storage::url('public/uploads/users/' . $file['filename']),
        ];
    }
}
