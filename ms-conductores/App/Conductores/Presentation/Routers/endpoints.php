<?php

use Slim\App;
use App\Conductores\Presentation\Repositories\ConductoresRepository;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {

    $app->post('/conductor', [ConductoresRepository::class, 'create']);
    $app->get('/conductor', [ConductoresRepository::class, 'all']);
    $app->get('/conductor/{id}', [ConductoresRepository::class, 'detail']);
    $app->put('/conductor/{id}', [ConductoresRepository::class, 'update']);
    $app->patch('/conductor/{id}', [ConductoresRepository::class, 'CambiarEstado']);
};