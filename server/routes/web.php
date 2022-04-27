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
$router->delete('/account/login', 'LoginController@delete');

$router->get('/user', 'UserController@list');
$router->get('/user/{id}', 'UserController@detail');
$router->post('/user', 'UserController@create');
$router->put('/user/{id}', 'UserController@update');
$router->delete('/user/{id}', 'UserController@delete');


$router->get('/incident', 'IncidentController@list');
$router->get('/incident/create', 'IncidentController@createData');
$router->get('/incident/{id}', 'IncidentController@detail');
$router->post('/incident', 'IncidentController@create');
$router->put('/incident/{id}', 'IncidentController@update');
$router->delete('/incident/{id}', 'IncidentController@delete');
