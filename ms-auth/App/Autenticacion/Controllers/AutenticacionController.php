<?php
namespace App\Autenticacion\Controllers;
use App\Autenticacion\Models\Autenticacion;
use Exception;
class AutenticacionController
{
    function login($data)
    {
        $identificador = $data['username_or_email'];
        $pass = $data['contrasena'];
        $usuario = Autenticacion::where('usuario', $identificador)
            ->orWhere('correo', $identificador)
            ->first();
        if (empty($usuario)) {
            throw new Exception("Credenciales incorrectas.", 1);
        }
        if ($pass != $usuario->contrasena) {
            throw new Exception("Credenciales incorrectas.", 1);
        }
        if ($usuario->estado == 'inactivo') {
            throw new Exception("El usuario se encuentra inactivo.", 403);
        }
        $usuario->sesion_activa = true;
        $usuario->save();

        return json_encode([
            "id" => $usuario->id,
            "nombre" => $usuario->nombre,
            "correo" => $usuario->correo,
            "usuario" => $usuario->usuario,
            "rol" => $usuario->rol,
            "mensaje" => "Inicio de sesión exitoso."
        ]);
    }
    function logout($usuarioId)
    {
        $usuario = Autenticacion::find($usuarioId);
        if (empty($usuario)) {
            throw new Exception("Usuario no encontrado.", 404);
        }
        $usuario->sesion_activa = false;
        $usuario->save();
        return json_encode([
            "mensaje" => "Sesion cerrada correctamente."
        ]);
    }
    function validarSesion($usuarioId)
    {
        $usuario = Autenticacion::find($usuarioId);
        if (empty($usuario)) {
            throw new Exception("Usuario no encontrado.", 404);
        }
        if (!$usuario->sesion_activa) {
            throw new Exception("Sesión inactiva.", 1);
        }
        return json_encode([
            "valido" => true,
            "usuario_id" => $usuario->id,
            "rol" => $usuario->rol
        ]);
    }
}