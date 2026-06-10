<?php
namespace App\Viajes\Controllers;

use App\Viajes\Models\Viaje;
use Exception;

class ViajesControllers
{
    function iniciarViaje($data){
        $seguimiento = new Viaje();

        $seguimiento->programacion_viaje_id = $data['programacion_viaje_id'];
        $seguimiento->fecha = $data['fecha'];
        $seguimiento->hora = $data['hora'];
        $seguimiento->estado = 'en_transito';
        $seguimiento->novedad = $data['novedad'] ?? null;
        $seguimiento->save();
        return $seguimiento->toJson();
    }

    function registrarNovedad($data){
        $seguimiento = new Viaje();

        $seguimiento->programacion_viaje_id = $data['programacion_viaje_id'];
        $seguimiento->fecha = $data['fecha'];
        $seguimiento->hora = $data['hora'];
        $seguimiento->estado = $data['estado'];
        $seguimiento->novedad = $data['novedad'] ?? null;

        $seguimiento->save();

        return $seguimiento->toJson();
    }

    function finalizarViaje($data){
        $seguimiento = new Viaje();

        $seguimiento->programacion_viaje_id = $data['programacion_viaje_id'];
        $seguimiento->fecha = $data['fecha'];
        $seguimiento->hora = $data['hora'];
        $seguimiento->estado = 'finalizado';
        $seguimiento->novedad = $data['novedad'] ?? null;

        $seguimiento->save();

        return $seguimiento->toJson();
    }

    function consultarSeguimiento($programacionViajeId){
        $seguimientos = Viaje::where(
            'programacion_viaje_id',
            $programacionViajeId
        )->get();

        if ($seguimientos->isEmpty()) {
            throw new Exception(
                "No existen seguimientos para la programación $programacionViajeId",
                1
            );
        }

        return $seguimientos->toJson();
    } 
 }