<?php

use Illuminate\Routing\Router;
//use App\Admin\Controllers\CategoryController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('auth/category', CategoryController::class);
    $router->resource('auth/product', ProductController::class);
    $router->resource('auth/attribute', AttributeController::class);
    $router->resource('auth/product-color', ProductColorController::class);
    $router->resource('auth/email-template', EmailTemplateController::class);
    $router->resource('auth/order', OrderController::class);
    $router->resource('auth/order-detail', OrderDetailController::class);
    $router->resource('auth/sale', SaleController::class);


});
