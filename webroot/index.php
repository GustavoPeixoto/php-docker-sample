<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Application;

$app = new Application();
$app->execute();
