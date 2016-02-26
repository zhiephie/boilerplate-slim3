<?php

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
// if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    // return false;
// }

require PATH_ROOT . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require PATH_ROOT . '/../config/setting.php';
$app = new \Slim\App($settings);

// Set up dependencies
require PATH_ROOT . '../app/dependency.php';

// Register middleware
require PATH_ROOT . '../app/middleware.php';

// Register routes
require PATH_ROOT . '../app/route.php';

// Register database
require PATH_ROOT . '/../config/database.php';

// Run app
$app->run();