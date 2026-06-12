<?php
namespace App\Conductores\Controllers;

use App\Conductores\Models\Conductor;
use Exception;
class ConductoresControllers {
     function getConductores($filtros = []){
        $query = Conductor::query();
        if (!empty($filtros['documento'])) {
            $query->where('documento', $filtros['documento']);
        }
        if (!empty($filtros['numero_licencia'])) {
            $query->where('numero_licencia', $filtros['numero_licencia']);
        }
        if (!empty($filtros['estado'])) {
            $query->where('estado', $filtros['estado']);
        }
        $rows = $query->get();
        return  $rows->toJson();
    }

    function crearConductor($data){
        $conductor = new Conductor();
        if (Conductor::where('documento', $data['documento'])->exists()) {
            throw new Exception("El documento de identificación ya está registrado.");
        }
        if (Conductor::where('numero_licencia', $data['numero_licencia'])->exists()) {
            throw new Exception("El número de licencia ya está registrado.");
        }
        if ($data['fecha_vencimiento_licencia'] <= date('Y-m-d')) {
            throw new Exception("La licencia del conductor está vencida. No se puede registrar.");
        }
        if (Conductor::where('correo', $data['correo'])->exists()) { 
            throw new Exception("El correo ya está registrado.");
}
        $conductor->nombres = $data['nombres'];
        $conductor->apellidos = $data['apellidos'];
        $conductor->documento= $data['documento'];
        $conductor->telefono = $data['telefono'];
        $conductor->correo = $data['correo'];
        $conductor->numero_licencia = $data['numero_licencia'];
        $conductor->categoria_licencia = $data['categoria_licencia'];
        $conductor->fecha_vencimiento_licencia = $data['fecha_vencimiento_licencia'];
        $conductor->estado = $data['estado'];
        $conductor->save();
        return $conductor->toJson();
    }

    function getConductor($id){
        $conductor = Conductor::find($id);
        if(empty($conductor)){
            throw new Exception("El conductor $id no existe", 1);
        }
        return $conductor;
    }

    function modificarConductor($id, $data){
        $conductor = $this->getConductor($id);
        if (Conductor::where('documento', $data['documento'])->where('id', '!=', $id)->exists()) {
            throw new Exception("El documento ya pertenece a otro conductor.");
        }
        if (Conductor::where('numero_licencia', $data['numero_licencia'])->where('id', '!=', $id)->exists()) {
            throw new Exception("La licencia ya pertenece a otro conductor.");
        }
        if (Conductor::where('correo', $data['correo'])->where('id', '!=', $id)->exists()) {
            throw new Exception("El correo ya pertenece a otro conductor.");
        }
        $conductor->nombres = $data['nombres'];
        $conductor->apellidos = $data['apellidos'];
        $conductor->documento= $data['documento'];
        $conductor->telefono = $data['telefono'];
        $conductor->correo = $data['correo'];
        $conductor->numero_licencia = $data['numero_licencia'];
        $conductor->categoria_licencia = $data['categoria_licencia'];
        $conductor->fecha_vencimiento_licencia = $data['fecha_vencimiento_licencia'];
        $conductor->estado = $data['estado'];
        $conductor->save();
        return $conductor;
    }
    function cambiarEstado($id, $nuevoEstado) {
        $conductor = $this->getConductor($id); 
        $this->validarEstado($nuevoEstado);
        $conductor->estado = $nuevoEstado;
        $conductor->save();
        return $conductor;
    }
    private function validarEstado($estado) {
        $estadosPermitidos = ['disponible', 'en_ruta', 'inactivo'];
        if (!in_array($estado, $estadosPermitidos)) {
            throw new Exception("Estado inválido. Debe ser: disponible, en_ruta o inactivo.");
        }
    }
     }