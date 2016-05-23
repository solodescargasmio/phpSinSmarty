<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formulario
 *
 * @author Yo
 */
require_once ('./conexion/conectar.php');
class formulario {
    private $id_form;
    private $nombre;
    private $version;
    private $fecha_crea;
            function __construct() {
        
    }
    public function getId_form() {
        return $this->id_form;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getVersion() {
        return $this->version;
    }

    public function setId_form($id_form) {
        $this->id_form = $id_form;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setVersion($version) {
        $this->version = $version;
    }
    
    public function getFecha_crea() {
        return $this->fecha_crea;
    }

    public function setFecha_crea($fecha_crea) {
        $this->fecha_crea = $fecha_crea;
    }

    
    function insertarFormulario() {
        $fecha=date('Y-m-d');
        $nombre=$this->getNombre();
        $version=  $this->getVersion();
        $conexion=  conectar::realizarConexion();
        $smtp=$conexion->prepare("INSERT INTO form (nombre,version,fecha_crea) VALUES(?,?,?)");
        $smtp->bind_param("sss",$nombre,$version,$fecha);
        $smtp->execute();
        $res=false;
        if($conexion->affected_rows>0){
            $res=true;
        }
        
        if($res){
         $resultado=$conexion->query("SELECT id_form FROM form WHERE nombre='".$nombre."' AND version='".$version."' AND fecha_crea='".$fecha."'");       
          while ($fila=$resultado->fetch_object()) {
         $dato=$fila->id_form;
           
} mysqli_close($conexion);
         return $dato;
         
        }
 }

  public function traerFormularios(){ 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT * FROM form group by nombre");   
 while ($fila=$resultado->fetch_object()) {
         $form=new formulario();
         $form->setId_form($fila->id_form);
         $form->setNombre($fila->nombre);
         $form->setVersion($fila->version);
            $formularios[]=$form;          
} mysqli_close($conexion);
       return $formularios;
 }
 
  public function traerTodosFormularios() { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM form");   
 while ($fila=$resultado->fetch_object()) {
         $form=new formulario();
         $form->setId_form($fila->id_form);
         $form->setNombre($fila->nombre);
         $form->setVersion($fila->version);
            $formularios[]=$form;          
} mysqli_close($conexion);
       return $formularios;
 }
 
 
   public function traerFormularioId() {
      $nombre= trim($this->getNombre());  
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query('SELECT * FROM form WHERE nombre="'.$nombre.'" AND fecha_crea=(SELECT MAX(fecha_crea) FROM form WHERE nombre="'.$nombre.'")');   
      while ($fila=$resultado->fetch_object()) {
         $form=new formulario();
         $form->setId_form($fila->id_form);
         $form->setNombre($fila->nombre);
         $form->setVersion($fila->version);
         $form->setFecha_crea($fila->fecha_crea);
               
} mysqli_close($conexion);
        return $form;
 }

  public function traerFormularioMayor() {
      $nombre= trim($this->getNombre()); 
      $dato=0;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query('SELECT * FROM form WHERE nombre="'.$nombre.'" AND id_form=(SELECT MAX(id_form) FROM form WHERE nombre="'.$nombre.'")');   
      while ($fila=$resultado->fetch_object()) {
         $dato=$fila->id_form;            
} mysqli_close($conexion);
        return $dato;
 }
 
 public function traerId($nombre){
  $conexion=  conectar::realizarConexion();
         $resultado=$conexion->query("SELECT id_form FROM form WHERE nombre='".$nombre."' AND fecha_crea =(SELECT MAX(fecha_crea) FROM form WHERE nombre='".$nombre."')");       
          while ($fila=$resultado->fetch_object()) {
         $dato=$fila->id_form;
        } mysqli_close($conexion);
        return $dato;
 }
 
 public function traerNombre($id_form){
  $conexion=  conectar::realizarConexion();
         $resultado=$conexion->query("SELECT nombre FROM form WHERE id_form=".$id_form);       
          while ($fila=$resultado->fetch_object()) {
         $dato=$fila->nombre;
        } mysqli_close($conexion);
        return $dato;
 }
 /**/
 public function traerCantidad(){  
     $dato=0;
     $id_form=$this->getNombre();
  $conexion= conectar::realizarConexion();
         $resultado=$conexion->query("SELECT COUNT(*) FROM form WHERE nombre='".$id_form."'");       
          while ($fila=$resultado->fetch_object()) {
             
              foreach ($fila as $value) {
                  
                 $dato=$value;
              }
        } mysqli_close($conexion);
        return $dato;
 }
 
 
 public function traerFormulariosNombre() {
      $nombre=trim($this->getNombre());  
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM form WHERE nombre='".$nombre."'");   
       while ($fila=$resultado->fetch_object()){
         $form=new formulario();
         $form->setId_form($fila->id_form);
         $form->setNombre($fila->nombre);
         $form->setVersion($fila->version);
         $form->setFecha_crea($fila->fecha_crea);
         $formularios[]=$form;
               
} mysqli_close($conexion);

        return $formularios;
 }
 
  public function modificarNombre($nuevo){
        $conexion=conectar::realizarConexion();
        $nombre=$this->getNombre();
      $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("UPDATE form SET nombre = ? WHERE nombre = ?" );
       $smtp->bind_param("ss",$nuevo,$nombre);
       $smtp->execute();
       $res=false;
      if($conexion->affected_rows>0){
       $res=true;
       }
       return $res;
 }
 
 /*UPDATE `phpfinal`.`form` SET `nombre` = 'sadi' WHERE `form`.`nombre` = 'sad';*/
}
