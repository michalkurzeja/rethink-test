<?php

namespace msales\Flyweight\BlueprintExample\Http\Controllers;

use msales\Flyweight\Config\Repository;
use msales\Flyweight\Http\Request;
use msales\Flyweight\Http\Response;
use msales\Flyweight\Routing\ResponseFactory;

class TestController extends Controller
{
    /**
     * Handle the request.
     *
     * @return Response
     */
    public function index(Request $request, Repository $config)
    {
        var_dump($config->get('caches'));

        return ResponseFactory::make('test');
    }
}