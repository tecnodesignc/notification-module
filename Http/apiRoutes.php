<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->notification('notification/mark-read', ['as' => 'api.notification.read', 'uses' => 'NotificationsController@markAsRead']);
$router->group(['prefix' => 'notification'], function (Router $router) {

    $router->get('/', [
        'as' => 'api.notification.notification.index',
        'uses' => 'NotificationsController@index',
        'middleware' => 'can:notification.notifications.index',
    ]);
    $router->get('/markAllAsRead', [
        'as' => 'api.notification.notification.markAllAsRead',
        'uses' => 'NotificationsController@markAllAsRead',
        'middleware' => 'can:notification.notifications.markAllAsRead',
    ]);
    $router->delete('/destroyAll', [
        'as' => 'api.notification.notification.destroyAll',
        'uses' => 'NotificationsController@destroyAll',
        'middleware' => 'can:notification.notifications.destroyAll',
    ]);
    $router->delete('/{notification}', [
        'as' => 'api.notification.notification.destroy',
        'uses' => 'NotificationsController@destroy',
        'middleware' => 'can:notification.notifications.destroy',
    ]);

});
