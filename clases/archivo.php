<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of archivo
 *
 * @author Yo
 */require_once ('./conexion/conectar.php');
class archivo {
    private $id_usuario;
    private $nombre;
    private $extension;
    function __construct() {
        
    }
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

              public function mostrarArchivo($id_user,$nombre){
                  $conexion=conectar::realizarConexion();
        $stmt = $conexion->prepare( 
"SELECT nombre,extension FROM archivo WHERE id_usuario=? AND nombre=?" );
        $stmt->bind_param( "is",$id_user,$nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
 while ($fila=$resultado->fetch_object()) {
            $archivo= new archivo();
            $archivo->setId_usuario($fila->id_usuario);
            $archivo->setNombre($fila->nombre);
            $archivo->setExtension($fila->extencion);
}
        return $archivo;
}
        

 public function listarArchivos($id_user){
     $conexion=conectar::realizarConexion();
        $stmt = $conexion->prepare( 
"SELECT * FROM archivo WHERE id_usuario=?" );
        $stmt->bind_param( "i",$id_user);
        $stmt->execute();
        $resultado = $stmt->get_result();
 while ($fila=$resultado->fetch_object()) {
            $archivo= new archivo(); 
            $archivo->setId_usuario($fila->id_usuario);
            $archivo->setNombre($fila->nombre);
            $archivo->setExtension($fila->extension);
            $total[]=$archivo;
}
        return $total;
}
        
        function insertarArchivo(){
            $conexion=conectar::realizarConexion();
    $id_user=  $this->getId_usuario();
    $nombre=  $this->getNombre();
    $extension=  $this->getExtension();
    $smtp=  $conexion->prepare("INSERT INTO archivo(id_usuario,nombre,extension)VALUES (?,?,?)");
    $smtp->bind_param('sss',$id_user,$nombre,$extension);
    $smtp->execute();
    $res=false;
      if($conexion->affected_rows>0){
        $res=true;
    }
    return $res;
    }
 

}
