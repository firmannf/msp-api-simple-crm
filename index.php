<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/src/dependencies.php';
require __DIR__ . '/src/routes.php';

$app->run();