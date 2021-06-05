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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([

    'middleware' => 'api',
    'prefix' => 'auth'

],function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->post('me', 'AuthController@me');

    // Matches "/api/profile
    $router->get('profile', 'UserController@profile');

});

$router->group(
    [
        'prefix' => 'api',
        'middleware' => 'auth:api',
    ],
    function () use ($router) {

    $router->post('announcement/create', 'AnnouncementController@create' );
    $router->get('announcement/{id}', 'AnnouncementController@find');
    $router->post('announcement/update', 'AnnouncementController@update');
    $router->get('announcements', 'AnnouncementController@all');

});
