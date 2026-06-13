<?php

namespace App\Conductores\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Conductores\Controllers\ConductoresControllers;
use Exception;

class ConductoresRepository
{
     function all(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $controller = new ConductoresControllers();
        $conductores = $controller->getConductores($params);
        $response->getBody()->write($conductores);
        return $response->withHeader("Content-Type", "application/json");
    }
    function create(Request $request, Response $response)
{
    try {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new ConductoresControllers();
        
        $conductor = $controller->crearConductor($data);
        
        $response->getBody()->write($conductor);
        return $response
            ->withStatus(201)
            ->withHeader("Content-Type", "application/json");
    } catch (Exception $ex) {
        $response->getBody()->write(json_encode([
            "error" => $ex->getMessage()
        ]));
        return $response
            ->withStatus(400)
            ->withHeader("Content-Type", "application/json");
    }
}
    function detail(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];

            $controller = new ConductoresControllers();
            $conductor = $controller->getConductor($id);

            $resposeBody = $conductor->toJson();
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

            $controller = new ConductoresControllers();
            $conductor = $controller->modificarConductor($id, $data);

            $dataResponse = $conductor->toJson();
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
    function CambiarEstado(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $body = $req->getBody()->getContents();
            $data = json_decode($body, true);
            $controller = new ConductoresControllers();
            $conductor = $controller->cambiarEstado(
                $id,
                $data['estado']
            );
            $resp->getBody()->write($conductor->toJson());
            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write(
                json_encode([
                    "error" => $ex->getMessage()
                ])
            );
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 404;
            }
            return $resp->withStatus($code)->withHeader("Content-Type", "application/json");
        }
    }
     }