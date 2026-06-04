<?php
namespace App\Vehiculos\Presentation\Repositories;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Vehiculos\Controllers\VehiculosController;
use Exception;
class VehiculosRepository
{
    function all(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $controller = new VehiculosController();
        $vehiculos = $controller->getVehiculos($params);
        $response->getBody()->write($vehiculos);
        return $response->withHeader("Content-Type", "application/json");
    }
    function create(Request $request, Response $response)
    {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new VehiculosController();
        $vehiculo = $controller->crearVehiculo($data);
        $response->getBody()->write($vehiculo);
        return $response
            ->withStatus(201)
            ->withHeader("Content-Type", "application/json");
    }
    function detail(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];

            $controller = new VehiculosController();
            $vehiculo = $controller->getVehiculo($id);
            $resposeBody = $vehiculo->toJson();
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
            $controller = new VehiculosController();
            $vehiculo = $controller->modificarVehiculo($id, $data);
            $dataResponse = $vehiculo->toJson();
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

            $controller = new VehiculosController();
            $vehiculo = $controller->cambiarEstado($id, $data['estado']);

            $dataResponse = $vehiculo->toJson();
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