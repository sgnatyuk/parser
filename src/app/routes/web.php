<?php

use Laravel\Lumen\Routing\Router;

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

/* @var Laravel\Lumen\Routing\Router $router */

$router->get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
$router->get('/posts/{id}', ['as' => 'show', 'uses' => 'IndexController@show']);
$router->get('/save', ['as' => 'save', 'uses' => 'IndexController@save']);

