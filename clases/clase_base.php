<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clase_base
 *
 * @author Yo
 */
require_once ('./conexion/conectar.php');
class clase_base {
    private $tabla;//nombre de la tabla en BD
    private $db;//esta es la que obtiene la conexion
    private $conectado;
    private $modelo;//com las clases son una extencion de clase_base
    //modelo es la clase declarada en ese momento
   
    public function _autoload($class) {
        print "autoloading $class\n";//carga la clase que necesitamos en el momento de declarar la clase hijo
        require_once ($class.'php');
    }
    //Esto se entiende, si tienen dudas, me preguntan.
    function __construct($tabla) {
        $this->tabla =(String) $tabla;
        $this->db = conectar::realizarConexion();
        $this->modelo = get_class($this);
    }
    public function getDB(){
        return $this->db;
    }
    //Funciones comunes a todas las clases
    public function getListado(){
    	$sql="select * from $this->tabla ";
           // var_dump($this->tabla);
    	$resultados=array();

          $resultado =$this->db->query($sql)   
            or die ("Fallo en la consulta");

        while ( $fila = $resultado->fetch_object() )
        {
            
            $objeto= new $this->modelo($fila);
            $resultados[]=$objeto;
        } 
     return $resultados;   
    }

    public function obtenerPorId($id){
        $sql="select * from $this->tabla where id=$id ";
        $res=NULL;
        $resultado =$this->db->query($sql)   
            or die ("Fallo en la consulta");
         if($fila = $resultado->fetch_object()) {
           $res= new $this->modelo($fila);
        }
        return $res;
    }
    public function borrar($id){
    	$sql="DELETE FROM $this->tabla WHERE id='$id'";
    	$resultado =$this->db->query($sql);
        $res=false;
        if($this->db->affected_rows>0){
            $res=true;
        }
        return $res;
    }
    
}
