<?php

$app = new \msales\Flyweight\Blueprint\Core\Application(
    realpath(__DIR__ . '/../')
);

require blueprint_base_path('bootstrap/app.php');

return $app;