<?php
namespace App\Viajes\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Viajes\Controllers\ViajesController;
use Exception;

class ViajesRepository
{
    function iniciarviaje(Request $request, Response $response)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);

            $controller = new ViajesController();
            $seguimiento = $controller->iniciarViaje($data);

            $response->getBody()->write($seguimiento);

            return $response
                ->withStatus(201)
                ->withHeader("Content-Type", "application/json");

        } catch (Exception $ex) {

            $response->getBody()->write(
                json_encode([
                    "error" => $ex->getMessage()
                ])
            );

            return $response
                ->withStatus(400)
                ->withHeader("Content-Type", "application/json");
        }
    }

    function registrarnovedad(Request $request, Response $response)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);

            $controller = new ViajesController();
            $seguimiento = $controller->registrarNovedad($data);

            $response->getBody()->write($seguimiento);

            return $response
                ->withStatus(201)
                ->withHeader("Content-Type", "application/json");

        } catch (Exception $ex) {

            $response->getBody()->write(
                json_encode([
                    "error" => $ex->getMessage()
                ])
            );

            return $response
                ->withStatus(400)
                ->withHeader("Content-Type", "application/json");
        }
    }

    function finalizarviaje(Request $request, Response $response)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);

            $controller = new ViajesController();
            $seguimiento = $controller->finalizarViaje($data);

            $response->getBody()->write($seguimiento);

            return $response
                ->withStatus(201)
                ->withHeader("Content-Type", "application/json");

        } catch (Exception $ex) {

            $response->getBody()->write(
                json_encode([
                    "error" => $ex->getMessage()
                ])
            );

            return $response
                ->withStatus(400)
                ->withHeader("Content-Type", "application/json");
        }
    }

    function consultarseguimiento(Request $request, Response $response, $args)
    {
        try {
            $viajeId = $args['viaje_id'];

            $controller = new ViajesController();
            $seguimientos = $controller->consultarSeguimiento($viajeId);

            $response->getBody()->write($seguimientos);

            return $response
                ->withHeader("Content-Type", "application/json");

        } catch (Exception $ex) {

            $response->getBody()->write(
                json_encode([
                    "error" => $ex->getMessage()
                ])
            );

            $code = 400;

            if ($ex->getCode() == 1) {
                $code = 404;
            }

            return $response
                ->withStatus($code)
                ->withHeader("Content-Type", "application/json");
        }
    }
}