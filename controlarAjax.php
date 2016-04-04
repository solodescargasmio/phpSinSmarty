<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./clases/formulario.php');
require_once ('./clases/atributo.php');
require_once ('./clases/admin.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/session.php');
error_reporting(0);
if($_POST['nom_formulario']){
$nomb=$_POST['nom_formulario'];
$formula=new formulario();
$formula->setNombre($nomb);
$form=$formula->traerFormularioId();
        if(isset($form)){
 echo '<br><h4><font style="color:red;">El formulario ya existe en base de datos<br> Puede ingresar una nueva version presionando Nueva Version </font></h4>';     
        }
}
        else
         if($_POST['formulario']){ 
                $attr=new atributo();
        $nomb=$_POST['formulario'];
        $formula=new formulario();
        $formula->setNombre($nomb);
        $form=$formula->traerFormularioId();
       
        $resultado=$attr->traerAtributosForm($form->getId_form());
        foreach ($resultado as $value) {      
      echo '<div class="form-group" id="'.$value->getNombre().'">';
       echo '<label  class="col-sm-8 control-label">'.strtoupper($value->getNombre()).' v('.$form->getVersion().')</label>';
       echo '<div class="col-lg-10">';
       echo '<input type="text" id="'.$value->getNombre().'" name="'.$value->getNombre().'" value="'.$value->getTipo().'" readonly=>';
        echo'<input type="button" id="'.$value->getNombre().'" value="-" style="color: red;" name="eliminar" ident="'.$value->getNombre().'" onclick="eliminarElementoDom()"></div></div>';
     
        }
        }else
            if($_POST['user']){
                $id_paciente=$_POST['user'];
                $estudio=new estudio_medico();
                $estudio=$estudio->traerEstudioId($id_paciente);
            if(isset($estudio)){
 echo '<h4><font style="color:red;font-weight: bold;">Ya existe el paciente en base de datos<br> Verifique la cedula </font></h4>';     
        }     
            }
            else
            if($_POST['idtraer']){
                $id_paciente=$_POST['idtraer'];
                 $attr=new atributo();
                 $formula=new formulario();
                 $resul=$formula->traerFormularios();
                 $estudio=new estudio_medico();
                $estudios=$estudio->traerFormEchos($id_paciente);
                $tam=count($resul);
          echo '<table class="table table-condensed" border="1"><tr class="success">';
          foreach ($resul as $key => $value) {
         echo '<td>'.strtoupper($value->getNombre()).'</td>';     
         }        
  echo '</tr>';
                echo '<tr>';
       if($estudios!=null){
          foreach ($resul as $key => $value){
             if($estudio->ok($id_paciente, $value->getId_form())){
                  Session::init();
                 $cedu=Session::get('cedula');
                
                 if($cedu!=null){
              echo '<td><a href="verFormulario.php?nombre='.$value->getNombre().'"><img src="./imagenes/si.png"/></a></td>';        
                 }else{
                     echo '<td><img src="./imagenes/si.png"/></td>';
                 }
   
             }else{  
                   echo '<td><img src="./imagenes/no.png" /></td>';
       }
         }        
     }
     echo '<tr>';
   
         echo '</tr>'; 
         echo '</table>';             
                 if($cedu!=null){}else{
         echo '<input type="submit" value="<<Trabajar con este paciente>>" class="form-control btn btn-primary" onClick=window.location="ingresar.php?idpaciente='.$id_paciente.'">';   
                 } }else
            if($_POST['admin']){
                $id_paciente=$_POST['admin'];
                $admin=new admin();
                $admin->setNick($id_paciente);
                $admin=$admin->traerAdmin();       
           if($admin==null){
 echo '<img src="./imagenes/no.png"/><font style="color:red;font-weight: bold;"> Error en usuario, el sistema reconoce mayusculas y minusculas. Verifique</font>';     
        }else{
            echo '<img src="./imagenes/si.png"/>';}     
            } else
            if($_POST['nick']){
                $id_paciente=$_POST['nick'];
                $admin=new admin();
                $admin->setNick($id_paciente);
                $admin=$admin->traerAdmin();
            if($admin!=null){
 echo '<img src="./imagenes/no.png"/><font style="color:red;font-weight: bold;"> El usuario ya existe en el sistema</font>';     
        }    
            }
//              else
//                if($_POST['inicio']){
//                var_dump("dentro");exit();}
//                else{
//               $inicio=$_POST['inicio'];
//              $atr=new atributo();
//            $form=new formulario();
//            $ca=$form->traerCantidad("ficha_patronimica");
//            $con=$atr->contarAtributos();
//            $total=0;
//           $fin=5; 
//            foreach ($con as $value) {
//             $ca=$value;   
//            }
//            $id='';
//            echo ' <br> <table class="table-responsive" border="1">  
//                <tr>
//                  <td>Nombre y tipo Campo:</td>
//               </tr>';
//            
//            $atributos=$atr->traerAtributosPaginados($inicio,$fin);
//            foreach ($atributos as $key => $value) {
//                echo '<tr class="agregar">';
//  echo'<td class=campo1><a style=cursor:pointer;><input type=text name=campo class=campo value='.$value->getNombre().' hidden=>'.$value->getNombre();
//  echo '&nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value='.$value->getTipo().' hidden="">'.$value->getTipo().'</a></td>';
//  echo '</tr>';
//}
//$inicio=$inicio+$fin;
//echo '<input type=text id=inicio value='.$inicio.'  hidden>';
//echo '<a href="#"> <button  class="btn btn-primary btn-group-sm">Siguiente >></button></a>';
//echo '</table>';        
//}
     
            
 