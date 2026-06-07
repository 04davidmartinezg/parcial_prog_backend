<?php

use Slim\App;
use App\Rutas\Presentation\Repositories\RutasRepository;
use App\Rutas\Presentation\Repositories\ProgViajesRepository;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {
$app->group('/ruta', function (RouteCollectorProxy $group) {
    $group->post('', [RutasRepository::class, 'create']);
    $group->get('', [RutasRepository::class, 'all']);
    $group->get('/{id}', [RutasRepository::class, 'detail']);
    $group->put('/{id}', [RutasRepository::class, 'update']);
});
$app->group('/progviaje', function (RouteCollectorProxy $group) {
    $group->post('', [ProgViajesRepository::class, 'create']);
    $group->get('', [ProgViajesRepository::class, 'all']);
    $group->get('/{id}', [ProgViajesRepository::class, 'detail']);
    $group->put('/{id}', [ProgViajesRepository::class, 'update']);
});
};