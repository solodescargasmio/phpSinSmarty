<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tabla
 *
 * @author Yo
 */require_once ('./conexion/conectar.php');
class tabla {
    private $id_atributo;
    private $opcion;
    function __construct() {
        
    }
    public function getId_atributo() {
        return $this->id_atributo;
    }

    public function getOpcion() {
        return $this->opcion;
    }

    public function setId_atributo($id_atributo) {
        $this->id_atributo = $id_atributo;
    }

    public function setOpcion($opcion) {
        $this->opcion = $opcion;
    }

public function ingresarTabla(){
     $id_attributo=$this->getId_atributo();
     $opcion=$this->getOpcion();
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("INSERT INTO tabla (id_attributo, opcion) VALUES (?,?)" );
       $smtp->bind_param("ss",$id_attributo,$opcion);
       $smtp->execute();
       $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       } mysqli_close($conexion);
      // var_dump($res);
    return $res;
 }
 
  public function traerTablas() { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM tabla");   
 while ($fila=$resultado->fetch_object()) {
         $tabla=new tabla();
         $tabla->setId_atributo($fila->id_attributo);
         $tabla->setOpcion($fila->opcion);
            $tablas[]=$tabla;          
} mysqli_close($conexion);
        return $tablas;
 }

}
