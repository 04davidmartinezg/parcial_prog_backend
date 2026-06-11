<?php

use Slim\App;
use App\Autenticacion\Presentation\Repositories\AutenticacionRepository;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->post('/login',   [AutenticacionRepository::class, 'login']);
    $app->post('/logout',  [AutenticacionRepository::class, 'logout']);
    $app->post('/validate', [AutenticacionRepository::class, 'validate']);
};