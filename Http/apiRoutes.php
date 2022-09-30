<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->notification('notification/mark-read', ['as' => 'api.notification.read', 'uses' => 'NotificationsController@markAsRead']);
$router->group(['prefix' => 'notification'], function (Router $router) {
    //Route create
    $router->notification('/', [
        'as' => 'api.notification.notification.create',
        'uses' => 'NotificationApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'api.notification.notification.index',
        'uses' => 'NotificationApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'api.notification.notification.show',
        'uses' => 'NotificationApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'api.notification.notification.update',
        'uses' => 'NotificationApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'api.notification.notification.delete',
        'uses' => 'NotificationApiController@delete',
        'middleware' => ['auth:api']
    ]);

});
