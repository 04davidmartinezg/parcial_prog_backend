<?php
namespace App\Rutas\Controllers;

use App\Rutas\Models\Ruta;
use Exception;
class RutasController {
     function getRutas($filtros = []){
        $query = Ruta::query();
        if (!empty($filtros['ciudad_origen'])) {
            $query->where('ciudad_origen', $filtros['ciudad_origen']);
            }
            if (!empty($filtros['ciudad_destino'])) {
                $query->where('ciudad_destino', $filtros['ciudad_destino']);
                }
                if (!empty($filtros['tiempo_estimado'])) {
                    $query->where('tiempo_estimado', $filtros['tiempo_estimado']);
                    }

        $rows = $query->get();
        return  $rows->toJson();
    }

    function crearRuta($data){
        if (Ruta::where('ciudad_origen', $data['ciudad_origen'])
            ->where('ciudad_destino', $data['ciudad_destino'])->exists()) {
        throw new Exception("La ruta ya existe.");
}
        if ($data['distancia'] <= 0) {
            throw new Exception("La distancia debe ser mayor a cero.");
        }
        $ruta = new Ruta();
        $ruta->ciudad_origen  = $data['ciudad_origen'];
        $ruta->ciudad_destino = $data['ciudad_destino'];
        $ruta->distancia = $data['distancia'];
        $ruta->tiempo_estimado = $data['tiempo_estimado'];
        $ruta->observaciones  = $data['observaciones'];
        $ruta->save();
        return $ruta->toJson();
    }

    function getRuta($id){
        $ruta = Ruta::find($id);
        if(empty($ruta)){
            throw new Exception("La ruta $id no existe", 1);
        }
        return $ruta;
    }

    function modificarRuta($id, $data){
        $ruta = $this->getRuta($id);
        if ($data['distancia'] <= 0) {
            throw new Exception("La distancia debe ser mayor a cero.");
        }
        $ruta->ciudad_origen = $data['ciudad_origen'];
        $ruta->ciudad_destino = $data['ciudad_destino'];
        $ruta->distancia = $data['distancia'];
        $ruta->tiempo_estimado = $data['tiempo_estimado'];
        $ruta->observaciones = $data['observaciones'];
        $ruta->save();
        return $ruta;
    }
    }