<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Configuration;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//bases
$router->post('/token', 'TokenController@create');
$router->put('/token-push', 'TokenPushController@change');
$router->put('/location', 'LocationController@change');
$router->get('/header', 'IncludeController@header');

//register
$router->post('/register/step1', 'RegisterController@step1');
$router->post('/register/step2', 'RegisterController@step2');
$router->post('/register/step3', 'RegisterController@step3');
$router->post('/register/step4', 'RegisterController@step4');
$router->post('/register/step5', 'RegisterController@step5');

//login
$router->post('/login/provider', 'LoginController@provider');
$router->get('/login/check', 'LoginController@check');
$router->post('/login', 'LoginController@login');
$router->post('/login/recover', 'LoginController@recover');

//inicial
$router->get('/home', 'HomeController@index');


//institucional
$router->get('/terms-of-use', function () {
    $config = Configuration::where('id', Configuration::TERMS_OF_USE)->first();
    return view('TermsUse', [
        'information' => $config->value
    ]);
});

$router->get('/privacy-policy', function () {
    $config = Configuration::where('id', Configuration::PRIVACY_POLICY)->first();
    return view('PrivacyPolicy', [
        'information' => $config->value
    ]);
});
