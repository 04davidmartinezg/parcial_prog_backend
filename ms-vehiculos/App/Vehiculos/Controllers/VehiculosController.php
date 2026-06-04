<?php
namespace App\Vehiculos\Controllers;

use App\Vehiculos\Models\Vehiculo;
use Exception;

class VehiculosController {

    function getVehiculos($filtros = []){
        $query = Vehiculo::query();
        
        if (!empty($filtros['placa'])) {
            $query->where('placa', $filtros['placa']);
        }
        if (!empty($filtros['estado'])) {
            $query->where('estado', $filtros['estado']);
        }
        if (!empty($filtros['tipo_vehiculo'])) {
            $query->where('tipo_vehiculo', $filtros['tipo_vehiculo']);
        }
        
        $rows = $query->get();
        return $rows->toJson();
    }
    function crearVehiculo($data){
        if (Vehiculo::where('placa', $data['placa'])->exists()) {
            throw new Exception("La placa del vehículo ya está registrada.");
        }
        if ($data['capacidad_carga'] <= 0) {
            throw new Exception("La capacidad de carga debe ser mayor a cero.");
        }
        $this->validarEstado($data['estado']);
        $vehiculo = new Vehiculo();
        $vehiculo->placa  = $data['placa'];
        $vehiculo->tipo_vehiculo  = $data['tipo_vehiculo'];
        $vehiculo->capacidad_carga = $data['capacidad_carga'];
        $vehiculo->modelo  = $data['modelo'];
        $vehiculo->marca  = $data['marca'];
        $vehiculo->estado  = $data['estado'];
        $vehiculo->save();
        return $vehiculo->toJson();
    }
    function getVehiculo($id){
        $vehiculo = Vehiculo::find($id);
        if(empty($vehiculo)){
            throw new Exception("El vehículo $id no existe", 1);
        }
        return $vehiculo;
    }
    function modificarVehiculo($id, $data){
        $vehiculo = $this->getVehiculo($id);
        if (Vehiculo::where('placa', $data['placa'])->where('id', '!=', $id)->exists()) {
            throw new Exception("La placa del vehículo ya está registrada.");
        }
        if (isset($data['capacidad_carga']) && $data['capacidad_carga'] <= 0) {
            throw new Exception("La capacidad de carga debe ser mayor a cero.");
        }
        if (isset($data['estado'])) {
            $this->validarEstado($data['estado']);
            $vehiculo->estado = $data['estado'];
        }
        $vehiculo->placa  = $data['placa'];
        $vehiculo->tipo_vehiculo  = $data['tipo_vehiculo'];
        $vehiculo->capacidad_carga = $data['capacidad_carga'];
        $vehiculo->modelo  = $data['modelo'];
        $vehiculo->marca  = $data['marca'];
        $vehiculo->save();
        return $vehiculo;
    }

    function cambiarEstado($id, $nuevoEstado) {
        $vehiculo = $this->getVehiculo($id); 
        $this->validarEstado($nuevoEstado);
        $vehiculo->estado = $nuevoEstado;
        $vehiculo->save();
        return $vehiculo;
    }

    private function validarEstado($estado) {
        $estadosPermitidos = ['disponible', 'en_ruta', 'mantenimiento', 'inactivo'];
        if (!in_array($estado, $estadosPermitidos)) {
            throw new Exception("Estado inválido. Debe ser: disponible, en_ruta, mantenimiento o inactivo.");
        }
    }
}