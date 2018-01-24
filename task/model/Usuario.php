<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author 2gdaw01
 */
class Usuario {
    //put your code here
    private $table = "bodegas";
    private $conexion;
    
     function __construct($conexion) {
        $this->conexion = $conexion;
    }
}
