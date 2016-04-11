<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./clases/formulario.php');
require_once ('./clases/session.php');
require_once ('./clases/estudio_medico.php');
Session::init();
$cedula= Session::get("cedula");
  $nombre=trim($_GET['nombre']);
  $ok=false;
if(isset($cedula)){
                       $est=new estudio_medico();
                       $estudios=$est->traerFormEchos($cedula);
                       foreach ($estudios as $dato){
                        $fo=new formulario();
                        $no=$fo->traerNombre($dato);
if(strcmp($no,$nombre)==0){
    $ok=true;
         }
    }

//fin foreach ($estudios as $dato)

}else{
    header('Location: muestroVersiones.php?nombre='.$nombre);
}
if($ok){header('Location: llenarFormularios.php?nombre="'.$nombre.'"&id_form='.$dato);}else{
 header('Location: muestroVersiones.php?nombre='.$nombre);   
}
//fin isset($cedula)





     
             
         
         
          