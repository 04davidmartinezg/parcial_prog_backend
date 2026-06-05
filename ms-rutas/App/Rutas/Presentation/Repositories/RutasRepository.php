<?php

namespace App\Rutas\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Rutas\Controllers\RutasController;
use Exception;

class RutasRepository
{
     function all(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $controller = new RutasController();
        $rutas = $controller->getRutas($params);
        $response->getBody()->write($rutas);
        return $response->withHeader("Content-Type", "application/json");
    }
       function create(Request $request, Response $response){
        try {
            $bodyRequest = $request->getBody()->getContents();
            $data = json_decode($bodyRequest, true);
            
            $controller = new RutasController();
            $ruta = $controller->crearRuta($data);
            
            $response->getBody()->write($ruta);
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

    function detail(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];

            $controller = new RutasController();
            $ruta = $controller->getRuta($id);

            $resposeBody = $ruta->toJson();
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

            $controller = new RutasController();
            $ruta = $controller->modificarRuta($id, $data);

            $dataResponse = $ruta->toJson();
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