<?php

use msales\Flyweight\BlueprintExample\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. These
| routes are loaded by the RouteServiceProvider.
|
*/

/**
 * @var \mSales\Flyweight\Contracts\Routing\Router $router
 */

$router->get('/', TestController::class . '@index');