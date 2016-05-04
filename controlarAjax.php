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
require_once ('./clases/crearBD.php');
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
       echo '<div class="form-group" id="'.$value->getNombre().'" style="border-width: 10px; background:#C8C0C0;">';     
      //echo '<div class="form-group" id="'.$value->getNombre().'">';
      echo '<label  class="col-sm-8 control-label">'.strtoupper($value->getNombre()).'</label>';
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
                 $estudio->setId_usuario($id_paciente);
                 $ca=$estudio->contarEstudiosPaciente();
                  Session::init();
                 $cedu=Session::get('cedula');
                 $id_estudio=Session::get('estudio');
                 $num=0;
                 if($ca==1){
                $estudios=$estudio->traerFormEchos($id_paciente);
                $tam=count($resul);
          echo '<table class="table table-condensed" border="1">'
                . '<tr class="danger"><td> Estudio Nº : '.$ca.'</td></tr>'
                  . '<tr class="success">';
          foreach ($resul as $key => $value) {
         echo '<td>'.strtoupper($value->getNombre()).'</td>';     
         }        
  echo '</tr>';
                echo '<tr>';
       if($estudios!=null){
          foreach ($resul as $key => $value){
             if($estudio->ok($id_paciente, $value->getId_form())){            
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
         echo '<input type="submit" value="<<Trabajar con este paciente (Estudio Nº '.$ca.')>>" class="btn btn-primary" onClick=window.location="ingresar.php?idpaciente='.$id_paciente.'&num='.$ca.'">';   
              echo '<br><br>';    }
           
                 
                 
                 
                 
                 }else{//  si hay mas de un estudio
    ///////////////////////////////////////////////////////////////////////////////////         
             for($i=0;$i<$ca;$i++){ 
                 $num=$i+1;
                $estudios=$estudio->traerFormEchosIdEstudios($id_paciente, $num);
          echo '<table class="table table-condensed" border="1">'
                . '<tr class="danger"><td> Estudio Nº : '.$num.'</td></tr>'
                  . '<tr class="success">';
          foreach ($resul as $key => $value) {
         echo '<td>'.strtoupper($value->getNombre()).'</td>';     
         }        
  echo '</tr>';
                echo '<tr>';
       if($estudios!=null){
          foreach ($resul as $key => $value){
             if($estudio->okMas($id_paciente, $value->getId_form(),$num)){
                 
                
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
         echo '<input type="submit" value="<<Trabajar con este paciente (Estudio Nº '.$num.')>>" class="btn btn-primary" onClick=window.location="ingresar.php?idpaciente='.$id_paciente.'&num='.$num.'">';   
         echo '<br><br>';   }
               } 
 ///////////////////////////////////////////////////////////////////////////////////                
            } //fin if else ca>1
            echo '<input type="submit" value="<<Crear un NUEVO ESTUDIO para este paciente Cedula: '.$id_paciente.'>>" class="btn btn-primary" onClick=window.location="crearestudio.php?idpaciente='.$id_paciente.'">'; 
              
                 }else
            if($_POST['idtraers']){
                $id_paciente=$_POST['idtraers'];
                 $attr=new atributo();
                 $formula=new formulario();
                 $resul=$formula->traerFormularios();
                 $estudio=new estudio_medico();
                 $estudio->setId_usuario($id_paciente);
                 $ca=$estudio->contarEstudiosPaciente();
                  Session::init();
                 $id_estudio=Session::get('estudio');
                  $num=Session::get('numero_estudio');
                $estudios=$estudio->traerFormEchosXestudios($id_paciente,$id_estudio);
                $tam=count($resul);
          echo '<table class="table table-condensed" border="1">'
                . '<tr class="danger"><td> Estudio Nº : '.$num.'</td></tr>'
                  . '<tr class="success">';
          foreach ($resul as $key => $value) {
         echo '<td>'.strtoupper($value->getNombre()).'</td>';     
         }        
  echo '</tr>';
                echo '<tr>';
       if($estudios!=null){
          foreach ($resul as $key => $value){
             if($estudio->okMas($id_paciente, $value->getId_form(),$num)){            
              echo '<td><a href="verFormulario.php?nombre='.$value->getNombre().'"><img src="./imagenes/si.png"/></a></td>';        
             }else{  
                   echo '<td><img src="./imagenes/no.png" /></td>';
       }
         }        
     }
     echo '<tr>';
   
         echo '</tr>'; 
         echo '</table>';             
                 if($cedu!=null){}else{
  echo '<br><br>';    }
 
 ///////////////////////////////////////////////////////////////////////////////////                
 
         echo '<input type="submit" value="<<Crear un NUEVO ESTUDIO para este paciente Cedula: '.$id_paciente.'>>" class="btn btn-primary" onClick=window.location="crearestudio.php?idpaciente='.$id_paciente.'">';  
                 }else
            if($_POST['admin']){
              require_once ('./clases/crearBD.php');  
                $id_paciente=$_POST['admin'];              
                crearBaseDeDatos();
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

     
            
 