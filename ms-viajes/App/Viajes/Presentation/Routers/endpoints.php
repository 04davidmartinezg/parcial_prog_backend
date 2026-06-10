<?php

use Slim\App;
use App\Viajes\Presentation\Repositories\ViajesRepository;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/seguimiento', function (RouteCollectorProxy $group) {
        $group->post('/iniciar', [ViajesRepository::class, 'iniciarviaje']);
        $group->post('/novedad', [ViajesRepository::class, 'registrarnovedad']);
        $group->post('/finalizar', [ViajesRepository::class, 'finalizarviaje']);
        $group->get('/{viaje_id}', [ViajesRepository::class, 'consultarseguimiento']);
    });
};