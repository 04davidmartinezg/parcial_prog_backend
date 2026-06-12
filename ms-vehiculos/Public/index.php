<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .'/../app/Config/database.php';

$cors = require __DIR__ . '/../app/Middlewares/CorsMiddleware.php';
$endpoints = require __DIR__ . '/../app/Vehiculos/Presentation/Routers/endpoints.php';

$app = AppFactory::create();

$cors($app);

$endpoints($app);

$app->run();
