<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    // $router->get('/licences/pending-audit', 'LicenceController@getPendingAudit');
    $router->resource('tags', TagController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('posts', PostController::class);
    $router->resource('licences', LicenceController::class);
    $router->resource('user-messages', UserMessageController::class);
    $router->resource('regions', RegionController::class);
});
