<?php
namespace App\Autenticacion\Presentation\Repositories;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Autenticacion\Controllers\AutenticacionController;
use Exception;
class AutenticacionRepository
{
    function login(Request $req, Response $resp)
    {
        try {
            $body = $req->getBody()->getContents();
            $data = json_decode($body, true);
            $controller = new AutenticacionController();
            $resultado = $controller->login($data);
            $resp->getBody()->write($resultado);
            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write(json_encode([
                "error" => $ex->getMessage()
            ]));
            $code = $ex->getCode();
            if ($code == 1) {
                $code = 401;
            }
            return $resp
                ->withStatus($code)
                ->withHeader("Content-Type", "application/json");
        }
    }
    function logout(Request $req, Response $resp)
    {
        try {
            $body = $req->getBody()->getContents();
            $data = json_decode($body, true);
            $controller = new AutenticacionController();
            $resultado = $controller->logout($data['id']);
            $resp->getBody()->write($resultado);

            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {

            $resp->getBody()->write(json_encode([
                "error" => $ex->getMessage()
            ]));

            $code = $ex->getCode();

            if ($code == 0) {
                $code = 400;
            }
            if ($code == 1) {
                $code = 401;
                }

            return $resp
                ->withStatus($code)
                ->withHeader("Content-Type", "application/json");
        }
    }
    function validate(Request $req, Response $resp)
    {
        try {
            $body = $req->getBody()->getContents();
            $data = json_decode($body, true);

            $controller = new AutenticacionController();
            $resultado = $controller->validarSesion($data['id']);

            $resp->getBody()->write($resultado);

            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");

        } catch (Exception $ex) {

            $resp->getBody()->write(json_encode([
                "error" => $ex->getMessage()
            ]));

            $code = $ex->getCode();}

            if ($code == 1) {
            $code = 401;
        }

            if ($code == 0) {
                $code = 400;
            }

            return $resp
                ->withStatus($code)
                ->withHeader("Content-Type", "application/json");
        }
    }