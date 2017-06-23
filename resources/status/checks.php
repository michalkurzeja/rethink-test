<?php

/*
|--------------------------------------------------------------------------
| Status Checks
|--------------------------------------------------------------------------
|
| Here is where you can register status checks for your application. These
| checks are loaded by the StatusServiceProvider.
|
*/

return [
    'deploy' => [
        msales\Flyweight\Status\NoopCheck::class,
    ],

    'health' => [
        msales\Flyweight\Blueprint\Status\DaemonStatusCheck::class,
    ],
];
