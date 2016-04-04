<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./clases/estudio_medico.php');
require_once('./clases/atributo.php');
error_reporting(0);
      $id_paciente=$_POST['service'];
       $estudio=new estudio_medico();
       $estudios=$estudio->traerLike($id_paciente);
       if(isset($estudios)){
       foreach ($estudios as $key => $value) {
           $attr1=new atributo();
           $nombat=$attr1->devolverNombre($value->getId_attributo());
           if(strcmp($nombat, "id_paciente")==0){
     echo '<div class="suggest-element"><a data="'.$value->getValor().'" id="'.$value->getValor().'"><font style="color:white;">'.$value->getValor().'</font></a></div>';      
           }  
       }
}else{
               echo '<font style="color:white;font-style: oblique;">Sin resultados</font>';    
           }
 





