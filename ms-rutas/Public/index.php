<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .'/../App/Config/database.php';

$cors = require __DIR__ . '/../App/Middlewares/CorsMiddleware.php';
$endpoints = require __DIR__ . '/../App/Rutas/Presentation/Routers/endpoints.php';

$app = AppFactory::create();

$cors($app);

$endpoints($app);

$app->run();