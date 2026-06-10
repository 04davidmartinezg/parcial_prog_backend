<?php

namespace App\Rutas\Controllers;

use App\Rutas\Models\ProgViaje;
use Exception;

class ProgViajesControllers {

    function getProgViajes($filtros = []){
        $query = ProgViaje::query();
        if (!empty($filtros['conductor_id'])) {
            $query->where('conductor_id', $filtros['conductor_id']);
        }
        if (!empty($filtros['vehiculo_id'])) {
            $query->where('vehiculo_id', $filtros['vehiculo_id']);
        }
        if (!empty($filtros['estado'])) {
            $query->where('estado', $filtros['estado']);
        }
        if (!empty($filtros['fecha'])) {
            $query->where('fecha_salida', $filtros['fecha']);
        }

        $rows = $query->get();
        return $rows->toJson();
    }
    function crearProgViaje($data){
        if (ProgViaje::where('conductor_id', $data['conductor_id'])->where('fecha_salida', $data['fecha_salida'])->exists()) {
            throw new Exception("El conductor ya tiene un viaje asignado para esa fecha.");
        }
        if (ProgViaje::where('vehiculo_id', $data['vehiculo_id'])->where('fecha_salida', $data['fecha_salida'])->exists()) {
            throw new Exception("El vehículo ya está asignado a otro viaje en esa fecha.");
        }
        $viaje = new ProgViaje();
        $viaje->conductor_id   = $data['conductor_id'];
        $viaje->vehiculo_id    = $data['vehiculo_id'];
        $viaje->ruta_id        = $data['ruta_id'];
        $viaje->fecha_salida   = $data['fecha_salida'];
        $viaje->hora_salida    = $data['hora_salida'];
        $viaje->fecha_estimada_llegada = $data['fecha_estimada_llegada'];
        $viaje->observaciones = $data['observaciones'] ?? null;
        $viaje->estado         = 'programado'; 
        $viaje->save();
        return $viaje->toJson();
    }
    function getProgViaje($id){
        $viaje = ProgViaje::find($id);
        if(empty($viaje)){
            throw new Exception("El viaje $id no existe", 1);
        }
        return $viaje;
    }
    function modificarProgViaje($id, $data){
        $viaje = $this->getProgViaje($id);
        if (ProgViaje::where('conductor_id', $data['conductor_id'])
            ->where('fecha_salida', $data['fecha_salida'])
        ->where('id', '!=', $id)
        ->exists()) {
            throw new Exception("El nuevo conductor elegido ya está ocupado en esa fecha.");
        }
        if (ProgViaje::where('vehiculo_id', $data['vehiculo_id'])
            ->where('fecha_salida', $data['fecha_salida'])
            ->where('id', '!=', $id)
            ->exists()) {
            throw new Exception("El nuevo vehículo elegido ya está ocupado en esa fecha.");
        }
        $viaje->conductor_id   = $data['conductor_id'];
        $viaje->vehiculo_id    = $data['vehiculo_id'];
        $viaje->fecha_salida   = $data['fecha_salida'];
        $viaje->hora_salida    = $data['hora_salida'];
        $viaje->fecha_estimada_llegada = $data['fecha_estimada_llegada'];
        $viaje->observaciones = $data['observaciones'] ?? null;
        $viaje->save();
        
        return $viaje;
    }
     }