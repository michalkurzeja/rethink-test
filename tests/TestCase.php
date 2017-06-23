<?php

namespace msales\Flyweight\BlueprintExample\Tests;

use msales\Flyweight\Core\Application;
use msales\Flyweight\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        return $app;
    }
}