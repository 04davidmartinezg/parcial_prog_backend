<?php

use Slim\App;
use App\Vehiculos\Presentation\Repositories\VehiculosRepository;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {

    $app->post('/vehiculo', [VehiculosRepository::class, 'create']);
    $app->get('/vehiculo', [VehiculosRepository::class, 'all']);
    $app->get('/vehiculo/{id}', [VehiculosRepository::class, 'detail']);
    $app->put('/vehiculo/{id}', [VehiculosRepository::class, 'update']);
    $app->patch('/vehiculo/{id}', [VehiculosRepository::class, 'CambiarEstado']);
};