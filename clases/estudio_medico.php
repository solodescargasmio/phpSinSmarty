<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estudio_medico
 *
 * @author Yo
 */require_once ('./conexion/conectar.php');
require_once ('atributo.php');
require_once ('formulario.php');
class estudio_medico {
    private $id_estudio;
    private $id_paciente;
    private $id_form;
    private $id_attributo;
    private $nom_attributo;
    private $tipo;
    private $valor;
    private $extencion;
    private $fecha_estudio;
    private $numero;
            function __construct() {
        
    }
  
    public function getFecha_estudio() {
        return $this->fecha_estudio;
    }

    public function getNumero() {
        return $this->numero;
    }
    public function setFecha_estudio($fecha_estudio) {
        $this->fecha_estudio = $fecha_estudio;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

        public function getExtencion() {
        return $this->extencion;
    }

    public function setExtencion($extencion) {
        $this->extencion = $extencion;
    }

        public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

        public function getNom_attributo() {
        return $this->nom_attributo;
    }

    public function setNom_attributo($nom_attributo) {
        $this->nom_attributo = $nom_attributo;
    }

        
    public function getId_estudio() {
        return $this->id_estudio;
    }

    public function getId_usuario() {
        return $this->id_paciente;
    }

    public function getId_form() {
        return $this->id_form;
    }

    public function getId_attributo() {
        return $this->id_attributo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setId_estudio($id_estudio) {
        $this->id_estudio = $id_estudio;
    }

    public function setId_usuario($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    public function setId_form($id_form) {
        $this->id_form = $id_form;
    }

    public function setId_attributo($id_attributo) {
        $this->id_attributo = $id_attributo;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

       public function ingresarEstudio(){ 
           $id_paciente= $this->getId_usuario();
           $fecha=date('Y-m-d');
           $con=$this->contarEstudiosPaciente();
           if($con==0){
               $numero=1;
           }else{
           $numero=$con+1;    
           }
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("INSERT INTO estudio_paciente (id_paciente,fecha_estudio,numero) VALUES (?,?,?)" );
       $smtp->bind_param("isi",$id_paciente,$fecha,$numero);
       $smtp->execute();
       $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       }
    if($res){
              $resultado=$conexion->query("SELECT id_estudio FROM estudio_paciente WHERE id_paciente=".$id_paciente." AND fecha_estudio='".$fecha."'");   
 while ($fila=$resultado->fetch_object()) {
         $dato=$fila->id_estudio;             
}      
       }      
       return $dato;
 }

public function ingresarEstudioForm(){
    
     $id_estudio=$this->getId_estudio(); 
    $id_att=$this->getId_attributo();
    $id_form=$this->getId_form();
     $valor=$this->getValor();
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("INSERT INTO estudio_atributo (id_estudio,id_form,id_attributo,valor) VALUES (?,?,?,?)" );
       $smtp->bind_param("iiis",$id_estudio,$id_form,$id_att,$valor);
       $smtp->execute();
       $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       } mysqli_close($conexion);
         
       return $res;
 }
 
    public function traerEstudioId($id_paciente) {   
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM estudio_paciente WHERE id_paciente=".$id_paciente);   
 while ($fila=$resultado->fetch_object()) {
         $estudio=new estudio_medico();
         $estudio->setId_estudio($fila->id_estudio);
         $estudio->setId_usuario($fila->id_paciente);
         $estudio->setId_estudio($fila->id_form);
} mysqli_close($conexion);
        return $estudio;
 } 
 
   public function traerFormEstudioId($id_estudio,$id_form) {
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM estudio_atributo WHERE id_estudio=".$id_estudio." AND id_form=".$id_form);   
 while ($fila=$resultado->fetch_object()) {
         $atr=new atributo();
         $estudio=new estudio_medico();   
         $estudio->setId_estudio($fila->id_estudio);
         $estudio->setId_form($fila->id_form);
         $estudio->setId_attributo($fila->id_attributo);
         $nom_att=$atr->devolverNombre($fila->id_attributo);
         $estudio->setNom_attributo($nom_att);
         $tipo=$atr->devolverTipo($fila->id_attributo);
         $estudio->setTipo($tipo);
         $estudio->setValor($fila->valor);
         
         $estudios[]=$estudio;
} mysqli_close($conexion);
        return $estudios;
 }
 
  public function traerFormId_usuario($id_paciente,$id_form) {
      $estudios=null;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT estudio_atributo.id_estudio,estudio_atributo.id_form,estudio_atributo.id_attributo,estudio_atributo.valor FROM estudio_atributo,estudio_paciente WHERE estudio_paciente.id_estudio=estudio_atributo.id_estudio AND estudio_paciente.id_paciente=".$id_paciente." AND estudio_atributo.id_form=".$id_form);   
 while ($fila=$resultado->fetch_object()) {
         $estudio=new estudio_medico();
         $estudio->setId_estudio($fila->id_estudio);
         $estudio->setId_form($fila->id_form);
         $estudio->setId_attributo($fila->id_attributo);
         $estudio->setValor($fila->valor);
         $estudios[]=$estudio;
          } mysqli_close($conexion);
        return $estudios;
 }
 
 public function traerPacientes(){
     
     $id_form=1;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM estudio_atributo WHERE  id_form=".$id_form);   
 while ($fila=$resultado->fetch_object()) {
         $estudio=new estudio_medico();
         $estudio->setId_attributo($fila->id_attributo);
         $estudio->setValor($fila->valor);  
         $estudios[]=$estudio;
} mysqli_close($conexion);
      return $estudios;
 }
 
 
  public function traerCedulas(){ 
      var_dump("traerCedulas");
     $id_form=1;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT valor FROM estudio_atributo WHERE id_form=1 AND id_attributo=1");   
while ($fila=$resultado->fetch_object()) {
         $estudio=new estudio_medico();
         $estudio->setId_attributo($fila->id_attributo);
         $estudio->setValor($fila->valor);  
         $estudios[]=$estudio;
} mysqli_close($conexion);
var_dump($estudios);exit();
      return $estudios;
 }
 /**/
 
 
 public function traerId($id_paciente,$num) {   
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT id_estudio FROM estudio_paciente WHERE id_paciente=".$id_paciente." AND numero=".$num);   
 while ($fila=$resultado->fetch_object()) {

         $dato=$fila->id_estudio;

} mysqli_close($conexion);
        return $dato;
 } 
 
 public function traerIdMas($id_paciente) {   
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT id_estudio FROM estudio_paciente WHERE id_paciente=".$id_paciente);   
 while ($fila=$resultado->fetch_object()) {
         $arr[]=$fila->id_estudio;
} mysqli_close($conexion);
        return $arr;
 }
 
 public function traerFormEchos($id_paciente){  
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT estudio_atributo.id_form FROM estudio_atributo,estudio_paciente WHERE estudio_atributo.id_estudio=estudio_paciente.id_estudio AND estudio_paciente.id_paciente=".$id_paciente);   
 while ($fila=$resultado->fetch_object()) {   
         $estudios[]=$fila->id_form;
          } mysqli_close($conexion);
        //  var_dump($estudios);exit();
        return $estudios;
 }
  public function traerFormEchosXestudios($id_paciente,$id_estudio){  
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT estudio_atributo.id_form FROM estudio_atributo,estudio_paciente WHERE estudio_atributo.id_estudio=estudio_paciente.id_estudio AND estudio_paciente.id_paciente=".$id_paciente." AND estudio_paciente.id_estudio=".$id_estudio);   
 while ($fila=$resultado->fetch_object()) {   
         $estudios[]=$fila->id_form;
          } mysqli_close($conexion);
        //  var_dump($estudios);exit();
        return $estudios;
 }
 
 public function traerFormEchosIdEstudios($id_paciente,$id_estudio){  
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT estudio_atributo.id_form FROM estudio_atributo,estudio_paciente WHERE estudio_atributo.id_estudio=estudio_paciente.id_estudio AND estudio_paciente.id_paciente=".$id_paciente." AND estudio_paciente.numero=".$id_estudio);   
 while ($fila=$resultado->fetch_object()) {   
         $estudios[]=$fila->id_form;
          } mysqli_close($conexion);
        //  var_dump($estudios);exit();
        return $estudios;
 }
 
     public function traerPacientesCedula($id_user){
     $id_form=1;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT * FROM estudio_atributo WHERE  id_form=".$id_form." AND valor=".$id_user);   
 while ($fila=$resultado->fetch_object()) {
         $estudio=new estudio_medico();
         $estudio->setId_attributo($fila->id_attributo);
         $estudio->setValor($fila->valor);  
         $estudios[]=$estudio;
} mysqli_close($conexion);
      return $estudios;
 }
 
  public function traerLike($id_paciente) {
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT estudio_atributo.id_attributo,estudio_atributo.valor FROM estudio_atributo,estudio_paciente WHERE estudio_paciente.id_estudio=estudio_atributo.id_estudio AND estudio_paciente.id_paciente like '%".$id_paciente."%'");   
 while ($fila=$resultado->fetch_object()) {
         $estudio=new estudio_medico();
         $estudio->setId_attributo($fila->id_attributo);
         $estudio->setValor($fila->valor); 
         $estudios[]=$estudio;
          } mysqli_close($conexion);
        return $estudios;
 }

 public function actualizaciones($clave,$valor){
     $id_est=  $this->getId_estudio();
     $id_form=  $this->getId_form();
      $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("UPDATE estudio_atributo SET valor='$valor' WHERE id_estudio=$id_est AND id_form=".$id_form." AND id_attributo=".$clave);
      $smtp->bind_param("siii",$valor,$id_est,$id_form,$clave);
      $smtp->execute();
      $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       } mysqli_close($conexion);
       return $res;
     
 }
 
 
 public function ok($id_paciente,$id_form){
     $form=new formulario();
     $nombre=$form->traerNombre($id_form);
     $ok=false;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT id_form FROM estudio_atributo,estudio_paciente WHERE estudio_paciente.id_paciente=".$id_paciente." AND estudio_atributo.id_estudio=estudio_paciente.id_estudio");   
 while ($fila=$resultado->fetch_object()) { 
     $nomb=$form->traerNombre($fila->id_form);
if(strcmp($nomb,$nombre)==0){   
         $ok=true;   
        }
    } mysqli_close($conexion);
        return $ok;
 }
 
 public function okMas($id_paciente,$id_form,$num){
     $form=new formulario();
     $nombre=$form->traerNombre($id_form);
     $ok=false;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT id_form FROM estudio_atributo,estudio_paciente WHERE estudio_paciente.id_paciente=".$id_paciente." AND estudio_atributo.id_estudio=estudio_paciente.id_estudio AND estudio_paciente.numero=".$num);   
 while ($fila=$resultado->fetch_object()) {
     $nomb=$form->traerNombre($fila->id_form);
if(strcmp($nomb,$nombre)==0){   
         $ok=true;   
        }
    } mysqli_close($conexion);
        return $ok;
 }
 
 public function traerIdFormEcho($nombre){
     $ok="";
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT form.id_form FROM form,estudio_atributo WHERE form.`id_form`=estudio_atributo.`id_form` AND form.`nombre`='".$nombre."'");   
 while ($fila=$resultado->fetch_object()) {
       $ok=$fila->id_form;
    } mysqli_close($conexion);
        return $ok;
 }

 public function nombreF($id_paciente,$id_form){
     $form=new formulario();
     $nombre=$form->traerNombre($id_form);
     $ok=false;
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT DISTINCT form.nombre FROM estudio_paciente,estudio_atributo,form WHERE estudio_atributo.id_form=form.id_form AND form.id_form=".$id_form." AND estudio_paciente.id_paciente=".$id_paciente);   
 while ($fila=$resultado->fetch_object()) { 
  if(isset($fila)){
      $ok=true;
  }
    } mysqli_close($conexion);
        return $ok;
 }
 
  public function contarEstudiosPaciente(){  
     $dato=0;
     $id_user=$this->getId_usuario();
  $conexion= conectar::realizarConexion();
         $resultado=$conexion->query("SELECT COUNT(*) FROM estudio_paciente WHERE id_paciente=".$id_user);       
          while ($fila=$resultado->fetch_object()) {
             
              foreach ($fila as $value) {
                  
                 $dato=$value;
              }
        } mysqli_close($conexion);
        return $dato;
 }
 
  public function traerEstudioMayor($id_paciente) {
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT id_estudio FROM estudio_paciente WHERE id_paciente=$id_paciente order by id_estudio desc LIMIT 0,1");   
 while ($fila=$resultado->fetch_object()) {
         $dato=0;
         $dato=$fila->id_estudio;

} mysqli_close($conexion);
        return $dato;
 } 
 
 
 public function traerNumero($id_estudio) {
     $conexion=conectar::realizarConexion();
      $resultado=$conexion->query("SELECT numero FROM estudio_paciente WHERE id_estudio=".$id_estudio);   
 while ($fila=$resultado->fetch_object()) {
         $dato=0;
         $dato=$fila->numero;

} mysqli_close($conexion);
        return $dato;
 } 

  public function eliminarEstudio($id_estudio) {
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("DELETE FROM estudio_paciente WHERE id_estudio=?");   
$smtp->bind_param("i",$id_estudio);
      $smtp->execute();
      $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       } mysqli_close($conexion);
       return $res;
  }
  
  public function eliminarFormulario($nombre) {
      $id_form=  $this->traerIdFormEcho($nombre);
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("DELETE FROM estudio_atributo WHERE id_form=?");   
$smtp->bind_param("i",$id_form);
      $smtp->execute();
      $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       } mysqli_close($conexion);
       return $res;
  }
  
  public function eliminarPaciente($id_paciente) {
     $conexion=conectar::realizarConexion();
      $smtp=$conexion->prepare("DELETE FROM estudio_paciente WHERE id_paciente=?");   
$smtp->bind_param("i",$id_paciente);
      $smtp->execute();
      $res=false;
       if($conexion->affected_rows>0){
       $res=true;
       } mysqli_close($conexion);
       return $res;
  }
  
//  public function dameNumero($id_paciente,$id_form,$num){
//     $form=new formulario();
//     $numero=0;
//     $nombre=$form->traerNombre($id_form);
//     $ok=false;
//     $conexion=conectar::realizarConexion();
//      $resultado=$conexion->query("SELECT DISTINCT id_form FROM estudio_atributo,estudio_paciente WHERE estudio_paciente.id_paciente=".$id_paciente." AND estudio_atributo.id_estudio=estudio_paciente.id_estudio AND estudio_paciente.numero=".$num);   
// while ($fila=$resultado->fetch_object()) {
//     $numero=$fila->id_form;
//     $nomb=$form->traerNombre($fila->id_form);
//if(strcmp($nomb,$nombre)==0){   
//         $ok=true;   
//        }
//    } mysqli_close($conexion);
//        return $numero;
// }
 /*SELECT DISTINCT form.nombre FROM estudio_paciente,estudio_atributo,form WHERE estudio_atributo.id_form=form.id_form AND form.id_form=11 AND estudio_paciente.id_paciente=12345678*/
}
