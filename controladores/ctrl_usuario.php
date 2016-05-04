<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./clases/atributo.php');
require_once ('./clases/formulario.php');
require_once ('./clases/form_attr.php');
require_once ('./clases/session.php');
require_once ('./clases/admin.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/datosPrecargados.php');
require_once ('ctrl_dinamico.php');
function ingresar(){
        $form=new formulario();
    $resultado=$form->traerFormularios();//obtengo todos los forms 
    //"Esto lo hago en todas las funciones para que cabeza.tpl siempre tenga los forms"
    if($resultado==null){
//si no existen formularios ingresados, ingreso todos los formularios precargados
              //con esto aseguro q los formularios y atributos se generen una sola ves
              cargarDatosPaciente();}
    
  error_reporting(0);
  $mensage="";
  $admin=new admin();
   Session::init();
    if($_POST['user']){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $passw=sha1($pass);
        $admin->setNick($user);
        $admin=$admin->traerAdmin();
        if($admin!=null){
 if((strcmp($user,$admin->getNick())==0) && (strcmp($passw,$admin->getPass())==0)){
     Session::set("nick", $user);
     if($admin->getTipo()==0){
                 Session::set("usuario", "admin");
            }else{
                Session::set("usuario", "comun"); 
                }
                header('Location: principal.php');
        }else {
        $mensage="Error en Contraseña.<br> El enlace a continuacion, envia una nueva contraseña a su correo registrado.<br>
                Utilizelo SOLO si no recuerda su contraseña. <a href='olvidePass.php?nick=$user'>Olvide mi contraseña</a>";     
        header("Location: index.php?mensage=".$mensage);
        }
      }else{
   $mensage="Error en Usuario.<br> Verifíque o comuniquese con el administrador de la Base de Datos";             
     header("Location: index.php?mensage=".$mensage);   }
    }
}
function cerrarSession() {
    Session::init();
    Session::destroy();
    header("Location: index.php"); 
}

////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
function olvidoPass(){//120704admin
	$mensaje="";
		$usr= new admin();
                if(isset($_GET['nick'])){
                $nick=$_GET['nick'];
                $usr->setNick($nick);
                $usr=$usr->traerAdmin();
                $email=$usr->getEmail();
 
		//$pass=sha1($_POST["password"]);
                    $d=mt_rand(1,123456);
                    $pass=$d.$nick;
                    $usr->setPass(sha1($pass));
                    if($usr->modificarPass()){
                    $cuerpo="Su nueva password es : ".$pass."<br>Ingrese "
                            . "<a href='http://localhost/sinSmarty/index.php'>aquí</a> con su usuario y la nueva password y luego modifique su password por una mas segura,"
                            . "<br>Gracias";
                    require_once ('./clases/enviarPHPmailer.php');
                    $envio=new enviarPHPmailer();
                     $asunto="Cambio de password";
                       //var_dump($asunto);exit();
                    $envio->enviar($email, $nick, $cuerpo, $asunto);          
		}
                $mensaje="Un mensaje se envió a su correo, verifíque";
                header("Location: index.php?mensage=".$mensaje);

}
}
////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
//
function modificarPerfil(){
      error_reporting(0);
      $mensage="";
      $admin=new admin();
   Session::init();
    $tipouser= Session::get("usuario");
    $nick= Session::get("nick");
    $admin->setNick($nick);
    $admin=$admin->traerAdmin();
    $vie=$admin->getPass();
     if($_POST){
         $viejo=$_POST['viejo'];
          $ad=new admin();
       $ad->setNick($_POST['nick']);
       $ad->setNombre($_POST['nombre']);
       $ad->setApellido($_POST['apellido']);
       $ad->setEmail($_POST['email']);
       $pas=$_POST["passw"];
       $pass=sha1($_POST["passw"]);
       if(strcmp($pass,"")==0){  
         $ad->setPass($vie);
       }else{
         $ad->setPass($pass);  
       }  
       if(!$ad->modificarPerfil($viejo)){   
       $mensage="Error al modificar sus datos. Verifique o contactese con el administrador de la Base de Datos";
 }
 header("Location: principal.php");
     }

}

function registrar(){
  error_reporting(0);
  $mensage="";
  $admin=new admin();
   Session::init();
    $tipouser= Session::get("usuario");
    $nick= Session::get("nick");
    if($_POST['registrar']){
       $ad=new admin();
       $ad->setNick($_POST['nick']);
       $ad->setNombre($_POST['nombre']);
       $ad->setApellido($_POST['apellido']);
       $ad->setEmail($_POST['email']);
      $pass=sha1($_POST["passw"]);
       $ad->setPass($pass);
       $tip=$_POST['privilegio'];
       $tipo=0;
       if(strcmp($tip, "todos")!=0){
           $tipo=1;
       }
       $ad->setTipo($tipo);
       
       if($ad->registrar()){ 
           $mensage="El registro se realizo con exito.";
          header("Location: registrar.php?mensage=".$mensage);
       }else{
           $mensage="Error al registrar usuario. Verifique e intentelo nuevamente.";
       header("Location: registrar.php?mensage=".$mensage);
           }
    }   
    
    
}
