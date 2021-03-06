<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

setlocale(LC_TIME, $app->getContainer()->get('config')->enviroment->lc_time);
ini_set("session.cookie_lifetime", $app->getContainer()->get('config')->enviroment->session_lifetime);
ini_set("session.gc_maxlifetime", $app->getContainer()->get('config')->enviroment->session_lifetime);
session_start();

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
// require __DIR__.'/../src/routes.php';

// App Loader
require __DIR__ . '/../app/app_loader.php';

// Run app
$app->run();
