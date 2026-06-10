<?php

namespace App\Rutas\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Rutas\Controllers\ProgViajesController;
use Exception;

class ProgViajesRepository
{
     function all(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $controller = new ProgViajesController();
        $progviajes = $controller->getProgViajes($params);
        $response->getBody()->write($progviajes);
        return $response->withHeader("Content-Type", "application/json");
    }
    function create(Request $request, Response $response)
    {
    try {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new ProgViajesController();
        $progviaje = $controller->crearProgViaje($data);
        $response->getBody()->write($progviaje);
        return $response
            ->withStatus(201)
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
    function detail(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];

            $controller = new ProgViajesController();
            $progviaje = $controller->getProgViaje($id);

            $resposeBody = $progviaje->toJson();
            $resp->getBody()->write($resposeBody);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 404;
            }
            return $resp->withStatus($code);
        }
    }

    function update(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $body = $req->getBody()->getContents();
            $data = json_decode($body, true);

            $controller = new ProgViajesController();
            $progviaje = $controller->modificarProgViaje($id, $data);

            $dataResponse = $progviaje->toJson();
            $resp->getBody()->write($dataResponse);
            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 404;
            }
            return $resp->withStatus($code);
        }
    }
     }