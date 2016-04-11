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
require_once ('./multimedia/crearMKdir.php');
require_once ('./clases/estudio_medico.php');
require_once ('./multimedia/crearMKdir.php');
 error_reporting(0);
   Session::init();
     
   $id_paciente=$_GET['idpaciente'];
      $ok=false;
      $atr=new atributo();
      $apellido="";
      $edad=0;
      $form=new formulario();
      $mensage="";
      $nombre="paciente";
        $idf=$form->traerId($nombre);
             $estudio=new estudio_medico();
             $estudio->setId_usuario($id_paciente);
             $estudio->setId_form($idf);
             $id_estudio=$estudio->traerEstudioMayor($id_paciente);
             $estu=$estudio->traerFormEstudioId($id_estudio, $idf);
             $est=new estudio_medico();
             $est->setId_usuario($id_paciente);
             $id_nuevo=$est->ingresarEstudio();
             $est->setId_estudio($id_nuevo);
             $est->setId_form($idf);
             foreach ($estu as $key => $value) {
                     $id_ap=$atr->devolverId("apellido");
                     $id_ed=$atr->devolverId("edad");
                 if($id_ap==$value->getId_attributo()){
                     $apellido=$value->getValor();
                 }
                 if($id_ed==$value->getId_attributo()){
                     $edad=$value->getValor();
                 }
                 $est->setId_attributo($value->getId_attributo());
             $est->setValor($value->getValor());
              if($est->ingresarEstudioForm()){
                 $ok=true;
             } 
}
 $nume=$estudio->traerNumero($id_nuevo);             
             Session::set("cedula",$id_paciente);
             Session::set("apellido", $apellido);
             Session::set("edad", $edad);
             Session::set("estudio", $id_nuevo);
             Session::set("numero_estudio", $nume);
             if($ok){//eliminar esto para que vuelva al mismo lugar
                $mensage="Los datos se ingresaron de forma correcta.";
       header('Location: principal.php?mensage='.$mensage);}

             
       
        /*
         * SELECT id_estudio FROM `estudio_paciente` WHERE `id_paciente`=12345678 order by `id_estudio` desc LIMIT 0,1
         * SELECT * FROM `estudio_paciente` WHERE `id_paciente`=12345678 order by `id_estudio` desc limit 0,1
SELECT DISTINCT * FROM `estudio_paciente`,`estudio_atributo` WHERE `estudio_paciente`.`id_paciente`=12345678 AND `estudio_paciente`.`id_estudio`=`estudio_atributo`.`id_estudio` AND `estudio_atributo`.`id_form`=1 
               */


