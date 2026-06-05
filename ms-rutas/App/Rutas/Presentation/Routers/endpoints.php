<?php

use Slim\App;
use App\Rutas\Presentation\Repositories\RutasRepository;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {
$app->group('/ruta', function (RouteCollectorProxy $group) {
    $group->post('', [RutasRepository::class, 'create']);
    $group->get('', [RutasRepository::class, 'all']);
    $group->get('/{id}', [RutasRepository::class, 'detail']);
    $group->put('/{id}', [RutasRepository::class, 'update']);
});
};