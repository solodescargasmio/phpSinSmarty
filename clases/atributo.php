<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of atributo
 *
 * @author Yo
 */
require_once ('./conexion/conectar.php');
class atributo {
    private $id_attributo=0;
    private $nombre="";
    private $tipo="";
    private $calculado=0;
    private $tabla=0;
    private $obligatorio=0;
  
   public function __construct() {
    }
    
    public function getObligatorio() {
        return $this->obligatorio;
    }

    public function setObligatorio($obligatorio) {
        $this->obligatorio = $obligatorio;
    }
   
    public function getTabla() {
        return $this->tabla;
    }

    public function setTabla($tabla) {
        $this->tabla = $tabla;
    }

        
    public function getId_attributo() {
        return $this->id_attributo;
    }

    public function setId_attributo($id_attributo) {
        $this->id_attributo = $id_attributo;
    }

        public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCalculado() {
        return $this->calculado;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTipo($tpo) {
        $this->tipo = $tpo;
    }

    public function setCalculado($calculado) {
        $this->calculado = $calculado;
    }

public function ingresarAtributo(){
     $nombre=$this->getNombre();
     $tipo=$this->getTipo();
     $calculado=$this->getCalculado();
     $tabla=  $this->getTabla();
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("INSERT INTO atributo (nombre, tipo, calculado,tabla) VALUES (?,?,?,?)" );
       $smtp->bind_param("ssii",$nombre,$tipo,$calculado,$tabla);
       $smtp->execute();
       $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       }
       if($res){
              $resultado=$conexion->query("SELECT id_attributo FROM atributo WHERE nombre='".$nombre."'");   
 while ($fila=$resultado->fetch_object()) {
         $dato=$fila->id_attributo;             
}      
       } mysqli_close($conexion);
    return $dato;
 }
 
 public function traerAtributos() { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM atributo");   
 while ($fila=$resultado->fetch_object()) {
         $atr=new atributo();
         $atr->setId_attributo($fila->id_attributo);
         $atr->setNombre($fila->nombre);
         $atr->setTipo($fila->tipo);
         $atr->setCalculado($fila->calculado);
         $atr->setTabla($fila->tabla);
            $atributos[]=$atr;          
} mysqli_close($conexion);
        return $atributos;
 }
 
 public function traerAtributosForm($id) {
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT atributo.id_attributo,atributo.nombre,atributo.tabla,atributo.tipo,atributo.calculado,form_attr.obligatorio FROM atributo,form_attr WHERE atributo.id_attributo=form_attr.id_attributo AND form_attr.id_form=".$id);   
          while ($fila=$resultado->fetch_object()) {
         $atr=new atributo();
         $atr->setId_attributo($fila->id_attributo);
         $atr->setNombre($fila->nombre);
         $atr->setTipo($fila->tipo);
         $atr->setTabla($fila->tabla);
         $atr->setObligatorio($fila->obligatorio);
            $atributos[]=$atr;          
} mysqli_close($conexion);
        return $atributos;
 }
 
 public function traerAtributosFormFile($id) {
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT atributo.id_attributo,atributo.nombre,atributo.tipo,atributo.calculado,form_attr.obligatorio FROM atributo,form_attr WHERE atributo.id_attributo=form_attr.id_attributo AND form_attr.id_form=".$id." AND atributo.tipo='file'");   
          while ($fila=$resultado->fetch_object()) {
         $atr=new atributo();
         $atr->setId_attributo($fila->id_attributo);
         $atr->setNombre($fila->nombre);
         $atr->setTipo($fila->tipo);
         $atr->setTabla($fila->tabla);
         $atr->setObligatorio($fila->obligatorio);
       
            $atributos[]=$atr;          
} mysqli_close($conexion);
        return $atributos;
 }
 
 
 public function devolverId($nombre) { 
     
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT id_attributo FROM atributo WHERE nombre='".$nombre."'");   
 while ($fila=$resultado->fetch_object()) {
         $dato=$fila->id_attributo;             
}
 mysqli_close($conexion);
        return $dato;
 }
 
  public function devolverNombre($id) { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT nombre FROM atributo WHERE id_attributo=".$id);   
 while ($fila=$resultado->fetch_object()) {

         $dato=$fila->nombre;             
} mysqli_close($conexion);
        return $dato;
 }
 
  public function devolverTipo($id) { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT tipo FROM atributo WHERE id_attributo=".$id);   
 while ($fila=$resultado->fetch_object()) {

         $dato=$fila->tipo;             
} mysqli_close($conexion);
        return $dato;
 }
 
 public function traerAtributosPaginados($inicio,$fin) { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM atributo LIMIT ".$inicio.",".$fin);   
 while ($fila=$resultado->fetch_object()) {
         $atr=new atributo();
         $atr->setId_attributo($fila->id_attributo);
         $atr->setNombre($fila->nombre);
         $atr->setTipo($fila->tipo);
         $atr->setCalculado($fila->calculado);
            $atributos[]=$atr;          
} mysqli_close($conexion);
        return $atributos;
 }
 
 public function contarAtributos() { 
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT COUNT(*) FROM atributo");   
  while ($fila=$resultado->fetch_object()) {
         $dato=$fila;
        } mysqli_close($conexion);
        return $dato;
 }
 
}
