<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notas
 *
 * @author 2gdaw01
 */
class Nota {
    //put your code here
    private $table = "nota";
    private $conexion;
    
    private $idNota;
    private $idTarea;
    private $descripcion;
    
    function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    function getIdNota() {
        return $this->idNota;
    }

    function getIdTarea() {
        return $this->idTarea;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdNota($idNota) {
        $this->idNota = $idNota;
    }

    function setIdTarea($idTarea) {
        $this->idTarea = $idTarea;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    
    public function save(){
        $consulta = $this->conexion->prepare("INSERT INTO nota (descripcion) VALUES (:descripcion) WHERE idTarea = :idTarea");
        $save = $consulta->execute(array(
            "descripcion" => $this->descripcion,
            "idTarea"=> $this->idTarea
        ));
        
        $this->conexion = null; 
        
        return $save;
    }
    
    public function getAllByIdTarea($idTarea){
        $consulta = $this->conexion->prepare("SELECT idNota, idTarea, descripcion FROM nota WHERE idTarea =".$idTarea);
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        $this->conexion = null; 
        return $resultados;
       
    }   
    
}
