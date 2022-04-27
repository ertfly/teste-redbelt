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

$router->post('/token', ['middleware' => 'noToken', 'uses' => 'TokenController@create']);

$router->get('/token', ['middleware' => 'out', 'uses' =>  'TokenController@detail']);
$router->post('/account/login', ['middleware' => 'out', 'uses' =>  'LoginController@submit']);

$router->delete('/account/login', ['middleware' => 'out', 'uses' =>  'LoginController@delete']);

$router->get('/user', ['middleware' => 'in', 'uses' =>  'UserController@list']);
$router->get('/user/{id}', ['middleware' => 'in', 'uses' =>  'UserController@detail']);
$router->post('/user', ['middleware' => 'in', 'uses' =>  'UserController@create']);
$router->put('/user/{id}', ['middleware' => 'in', 'uses' =>  'UserController@update']);
$router->delete('/user/{id}', ['middleware' => 'in', 'uses' =>  'UserController@delete']);


$router->get('/incident', ['middleware' => 'in', 'uses' =>  'IncidentController@list']);
$router->get('/incident/create', ['middleware' => 'in', 'uses' =>  'IncidentController@createData']);
$router->get('/incident/{id}', ['middleware' => 'in', 'uses' =>  'IncidentController@detail']);
$router->post('/incident', ['middleware' => 'in', 'uses' =>  'IncidentController@create']);
$router->put('/incident/{id}', ['middleware' => 'in', 'uses' =>  'IncidentController@update']);
$router->delete('/incident/{id}', ['middleware' => 'in', 'uses' =>  'IncidentController@delete']);
