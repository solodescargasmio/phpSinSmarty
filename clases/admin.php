<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Yo
 */require_once ('./conexion/conectar.php');
class admin {
 public $id=0;
 public $nick = '';
    public $nombre = '';
    public $apellido = '';
    public $email='';
    public $pass='';
    public $tipo='';
    function __construct() {
        
    }
    public function getNick() {
        return $this->nick;
    }

    public function setNick($nick) {
        $this->nick = $nick;
    }

        public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }


public function traerAdmin() { 
    $nick=$this->getNick();
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM administrador WHERE nick='".$nick."'");   
 while ($fila=$resultado->fetch_object()) {
       $admin=new admin();
       $admin->setNick($fila->nick);
       $admin->setNombre($fila->nombre);
       $admin->setPass($fila->pass);
       $admin->setEmail($fila->email);
       $admin->setApellido($fila->apellido);
       $admin->setTipo($fila->tipo);
}
mysqli_close($conexion);
        return $admin;
 }
 
 public function registrar(){
     $nick=  $this->getNick();
    $nombre=  $this->getNombre();
    $apellido=  $this->getApellido();
    $email=  $this->getEmail();
    $pass=  $this->getPass(); 
    $tipo=  $this->getTipo();
 
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("INSERT INTO administrador (nick,nombre, apellido, email, pass, tipo) VALUES (?,?,?,?,?,?)" );
       $smtp->bind_param("sssssi",$nick,$nombre,$apellido,$email,$pass,$tipo);
       $smtp->execute();
       $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       }
       mysqli_close($conexion);
       return $res;
 }
 
 /*UPDATE `phpfinal`.`administrador` SET `pass` = 'noesjose' WHERE `administrador`.`id` = 4;*/

 public function modificarPass(){
        $conexion=conectar::realizarConexion();
        $nick=$this->getNick();
        $pass=$this->getPass();
        
$stmt = $conexion->prepare("UPDATE administrador SET pass =? WHERE nick =?" );
       $stmt->bind_param("ss",$pass,$nick);
        $stmt->execute();
  $res=false;
        if($conexion->affected_rows>0){
            $res=true;
        } 
        mysqli_close($conexion);
        return $res; 
 }
 
 public function modificarPerfil($viejo){
        $conexion=conectar::realizarConexion();
         $nick=  $this->getNick();
         $nombre=  $this->getNombre();
         $apellido=  $this->getApellido();
         $email=  $this->getEmail();
         $pass=  $this->getPass(); 

$stmt = $conexion->prepare("UPDATE administrador SET nick=?,nombre=?,apellido=?,email=?,pass =? WHERE nick =?" );
       $stmt->bind_param("ssssss",$nick,$nombre,$apellido,$email,$pass,$viejo);
        $stmt->execute();
  $res=false;
        if($conexion->affected_rows>0){
            $res=true;
        } 
        mysqli_close($conexion);
        return $res; 
 }
 
}
