<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->get('/token', 'TokenController@detail');

$router->post('/account/login', 'LoginController@submit');
