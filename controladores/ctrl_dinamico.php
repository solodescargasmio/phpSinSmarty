<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
require_once ('./clases/atributo.php');
require_once ('./clases/formulario.php');
require_once ('./clases/form_attr.php');
require_once ('./multimedia/eliminarArchivos.php');
require_once ('./clases/session.php');
require_once ('./clases/tabla.php');
require_once ('./multimedia/guardarMultimedia.php');
require_once ('./multimedia/crearMKdir.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/datosPrecargados.php');
require_once ('./multimedia/crearMKdir.php');
require_once ('./multimedia/guardarMultimedia.php');
function principal(){ 
 error_reporting(0);
    Session::init();
    $tipouser=  Session::get("usuario");
    $nick=  Session::get("nick");
   if($_GET['idpaciente']){//trabajar con este paciente
      $id_user=$_GET['idpaciente'];
      $num=$_GET['num'];
      $estudio=new estudio_medico();
      $nume=$estudio->traerId($id_user, $num);
       $form=new formulario();
       $id_form=$form->traerId("paciente"); 
       Session::set("estudio", $nume); 
       Session::set("numero_estudio", $num);
       $estudios=$estudio->traerFormId_usuario($id_user, $id_form);
       foreach ($estudios as $key => $value){   
           $attr1=new atributo();
           $nombat=$attr1->devolverNombre($value->getId_attributo());
           if(strcmp($nombat, "id_paciente")==0){
            Session::set("cedula", $value->getValor());  
           }else if(strcmp($nombat, "apellido")==0){
            Session::set("apellido", $value->getValor());  
           }else
               if(strcmp($nombat, "edad")==0){
            Session::set("edad", $value->getValor()); 
           }
       }
       header("Location: principal.php");
         }//fin trabajar con este paciente
    $id_user=Session::get('cedula');
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
    $mensage="";

}

////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
function cerrar() {
    Session::init();
    $tipo=Session::get("usuario");
    $nick=Session::get("nick");
    Session::destroy();
    Session::init();
    Session::set("usuario", $tipo);
    Session::set("nick", $nick);
    header('Location: principal.php');
}


 ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////                
                 
                 
function ingresarAtributo() {
     Session::init();
     $nick=  Session::get("nick");
    $id_user=Session::get('cedula');
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
     $tipouser=  Session::get("usuario");
    error_reporting(0);
    $mensage="";
    if($_POST['nombre']){
        if($_POST['selectortexto']){
            
            $arreglo=$_POST['selectortexto'];
       $atr=new atributo();
    $atr->setNombre($_POST['nombre']);
    $atr->setTipo("text");  
    $atr->setTabla(1);
    $id_attributo=$atr->ingresarAtributo();
    $dato=  explode(",",$arreglo);
    foreach ($dato as $value){
        $tabla=new tabla();
        $tabla->setId_atributo($id_attributo);
        $tabla->setOpcion($value);
       if($tabla->ingresarTabla()){
        $mensage="Los datos se agregaron con éxito";   
       }else{
           $mensage="Error al ingresar los datos. Verifique"; 
       }
        
    }
    header('Location: ingatributos.php?mensage='.$mensage); //volvé aa atributos
    
    }else{
    $atr=new atributo();
    $atr->setNombre($_POST['nombre']);
    $atr->setTipo($_POST['selector']);
    $atr->setCalculado(0);
    $atr->setTabla(0);
    if($atr->ingresarAtributo()){//eliminar esto para que vuelva al mismo lugar
        $mensage="Los datos se agregaron con éxito";
    } else{
  $mensage="Error al ingresar atributo. Verifique.";        
    } }
    header('Location: ingatributos.php?mensage='.$mensage); //volvé aa atributos
  }
                 $form=new formulario();
          $resultados=$form->traerFormularios();
          if($resultados!=null){
          foreach ($resultados as $key => $value) {
         $formularios[]=$value;
          }}
}


////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

    function crearFormulario() {
     
        error_reporting(0);
        /*    'cantidad' => $con,
    'limite' => $lim,
    'totalpaginas' => $total,
            'actual' => $actual,*/
         Session::init();
         $nick=  Session::get("nick");
    $id_user=Session::get('cedula');
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
     $tipouser=  Session::get("usuario");
            $mensage="";
   if($_POST['nom_formulario']){
       $dato=$_POST;
$cant=  count($dato);
$id=0;
$con=0;
$va=$_POST['nom_formulario'];
$nombr=trim($va);
$nombre=str_replace(' ','_',$nombr); 
        $form=new formulario();
        $form->setNombre($nombre);
        $con=$form->traerCantidad(); 
        if($con>0){
            $mensage="El formulario ya existe, ingrese una versión nueva";
        }else{
        $version=1;
        $form->setVersion($version);
        $idf=$form->insertarFormulario();//al guardar el form, obtengo al id del form
         $fo_att=new form_attr();
        $fo_att->setId_form($idf); 
foreach ($dato as $key => $value){ 
    /////////////////////////////////////////////
 if((strcmp($key, 'nom_formulario')==0)){ }
 else if(is_numeric($key)){
     $fo_att->setId_atributo($key);
     $fo_att->insertarFormulario();
     $fo_att->obligatorio();
      $mensage="Los datos se guardaron con éxito."; 
 }
 else{ 
        $attr=new atributo();
        $ida=$attr->devolverId($key);//obtengo el id del atributo
        $fo_att->setId_atributo($ida); 
      //  var_dump();
        $fo_att->insertarFormulario();
         $mensage="Los datos se guardaron con éxito."; 
    }
///////////////////////////////////////////////
    }
  
 }
    }
      $atr=new atributo();            
 $resultado=$atr->traerAtributos();
 if($resultado==null){
          $mensage="Aun no hay atributos.<br> Ingrese atributos en la base de datos.";  
        }
      header('Location: crearFormularios.php?mensage='.$mensage);                
}

////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

function nuevaVersion(){
     Session::init();
     $nick=  Session::get("nick");
    $id_user=Session::get('cedula');
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
     $tipouser=  Session::get("usuario");
      error_reporting(0);
            $mensage="";
            if($_POST['nom_formulario']){
               $dato=$_POST;
        $cant=  count($dato);
        $id=0;
        $con=0;
        $ok=false;
        
        $nombre=trim($_POST['nom_formulario']);
        $form=new formulario();
        $form->setNombre($nombre);
        $con=$form->traerCantidad();
         $version=$con+1;    
                $form->setNombre($nombre);
                $form->setVersion($version);
                $idf=$form->insertarFormulario();
                 $fo_att=new form_attr();
                $fo_att->setId_form($idf); 
              
        foreach ($dato as $key => $value){  
            
         if((strcmp($key, 'nom_formulario')==0)){ }
         else{  
                $attr=new atributo();
                $ida=$attr->devolverId($key);
                $fo_att->setId_atributo($ida); 
                if($fo_att->insertarFormulario()){
                   $ok=true; 
                }
            }

            }
            

            }
      $atr=new atributo();            
 $resultado=$atr->traerAtributos();
 if($resultado==null){
          $mensage="Aun no hay atributos.<br> Ingrese atributos en la base de datos.";  
        }
        if($ok){$mensage="Los datos se guardaron con éxito.";}else{
          $mensage="Error al ingresar los datos. Verifique.";  
        }
       header('Location: version.php?mensage='.$mensage);  
}

////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

function dependenciasForm(){
     Session::init();
     $nick=  Session::get("nick");
    $id_user=Session::get('cedula');
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
     $tipouser=  Session::get("usuario");
         error_reporting(0);
            $mensage="";
    if($_POST){ 
        $dato1=$_POST['selector'];
        $dato2=$_POST['selector1'];
       $fromu=new formulario();      
       $depen=new dependencia();
       if($depen->insertarDependencias($dato1, $dato2)){
        $mensage="Los datos fueron agregados con éxito";    
       }else{
           $mensage="No se pudo agregar la dependencia. Verifique"; 
       }
    }
    
    if($_GET['ide']){
        $id=$_GET['ide'];
       $depen=new dependencia();
       if($depen->eliminarDepende($id)){
           $mensage="La dependencia se eliminó con éxito.";
       }else{
        $mensage="No se pudo eliminar la dependencia. Verifique";   
       }
    }

  header('Location: dependencia.php?mensage='.$mensage);     
}


////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
function formularios(){
    
    Session::init();
    $nick=Session::get("nick");
    $id_user=Session::get('cedula');
    $id_paciente=$id_user;
    $id_estudio= Session::get("estudio"); 
     error_reporting(0);
     $ok=true;
       $mensage="";
        $nombre=$_POST['nomformulario'];
        $atr=new atributo();
        $tabla=new tabla();
        $form=new formulario();
        $idf=$form->traerId($nombre);
if($_POST['modificar']){
             $estudio=new estudio_medico();
             $estudio->setId_usuario($id_user);
             $idf=$_POST["nomformulario"];
             $estudio->setId_form($idf);
             $estudio->setId_estudio($id_estudio);
         if(strcmp($nomf, "paciente")==0){
             Session::set("cedula",$id_paciente);
             Session::set("apellido", $_POST['apellido']);
             Session::set("edad", $_POST['edad']);
         }    
               $datos=$_POST; 
             //  
            $ok=false;   
          foreach ($datos as $key => $value) { 
            if((strcmp($key,"nomformulario")==0)||(strcmp($key,"modificar")==0)){}
             else{ 
             $aa=new atributo();
                $id_attributo=$aa->devolverId($key); 
            if($estudio->actualizaciones($id_attributo, $value)){
                $ok=true;
           
                }  
         }
        }
        if(isset($_FILES)){
            eliminarArchivo($idf);
            }
        if($ok){//eliminar esto para que vuelva al mismo lugar
            $mensage="Los datos se modificaron de forma correcta.";
       header('Location: principal.php?mensage='.$mensage);
        exit();}
       }else  
        if($_POST['nomformulario']){
            $nomf=$_POST['nomformulario'];
            if(isset($_POST['id_paciente'])){
              $id_paciente=$_POST['id_paciente'];  
            }else{
             $id_paciente=$id_user;   
            }
             $estudio=new estudio_medico();
             $estudio->setId_usuario($id_paciente);
             $estudio->setId_form($idf);
         if(strcmp($nomf, "paciente")==0){
             
             Session::set("cedula",$id_paciente);
             Session::set("apellido", $_POST['apellido']);
             Session::set("edad", $_POST['edad']);
             crearDir($id_paciente);
             $id_estudio=$estudio->ingresarEstudio();
             Session::set("estudio", $id_estudio);
             $num=$estudio->traerNumero($id_estudio);
             Session::set("numero_estudio", $num);
         }
            
             $estudio->setId_estudio($id_estudio);
               $datos=$_POST;
               
               $ok=false;
         foreach ($datos as $key => $value) {
            if(strcmp($key, "nomformulario")!=0){
              
             $id_attributo=$atr->devolverId($key);
             $estudio->setId_attributo($id_attributo);
             $estudio->setValor($value);
             if($estudio->ingresarEstudioForm()){
                 $ok=true;
             }   
         }
        
        }
         if(isset($_FILES)){
          //var_dump($_FILES);exit();
subirDatos($idf);
            }
        
      if($ok){//eliminar esto para que vuelva al mismo lugar
                $mensage="Los datos se ingresaron de forma correcta.";
       header('Location: principal.php?mensage='.$mensage);}
       } 
        if($dat>0){
        $resultado=$atr->traerAtributosForm($idf);
        $tablas=$tabla->traerTablas(); 
        if($tablas!=null){
          foreach ($tablas as $keys => $values) {
             // var_dump($values);exit();
         $selectos[]=$values;
          }}
        if($resultado==null){
          $mensage="No existen atributos para este formulario.<br> Ingrese una nueva versión del formulario.";  
        }
           //
        }
         header('Location: principal.php?mensage='.$mensage);
                 }           
     



////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////



function guardarArchivos(){
    subirDatos();//Esta funcion esta en la carpeta multimedia 
    //en el archivo guardar...php
}


function paginado(){
    error_reporting(0);
       Session::init();
       $nick=  Session::get("nick");
    $id_user=Session::get('cedula');
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
     $tipouser=  Session::get("usuario");
        $atr=new atributo();
            $mensage="";
    $tpl=new Template();
    $titulo="Estudios Médicos";
             if($_POST['ini']){
               $inicio=$_POST['ini'];
               $actual=1+ceil($inicio/5);
//            $paginador->setCantidadRegistros($totalpag);
//                if(isset ($_POST['inicio'])){
//                    $inicio=$_POST['inicio'];
//                }
            //$paginador->
            $id='';
            $resultado=$atr->traerAtributosPaginados($inicio,$fin);
               }else{
               $resultado=$atr->traerAtributos();}
              
               $depencia=new dependencia();
        $dependencias=$depencia->traerDependencias();
        $form=new formulario();
          $resultados=$form->traerFormularios();
          if($resultados!=null){
          foreach ($resultados as $key => $value) {
         $formularios[]=$value;
          }}
     $datos=array(
         "nick" => $nick,
             "operador" => $tipouser,
            "atributos" => $resultado,
            "mensage" => $mensage,
            "dependencias" => $dependencias
        );
           $tpl->asignar('edad', $edad);
    $tpl->asignar('cedula', $id_user);
    $tpl->asignar('apellido', $apell);
   $tpl->asignar( "formularios", $formularios);
    
           $tpl->asignar("titulo", $titulo);
        $tpl->mostrar("paginado",$datos);   
}

function verFormularios(){
Session::init();
$nick=  Session::get("nick");
    $id_user=Session::get('cedula');
    $id_paciente=$id_user;
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
    $id_estudio= Session::get("estudio"); 
     $tipouser=  Session::get("usuario");
     error_reporting(0);
       $mensage="";
        $nombre=$_GET['nombre'];
        
        $atr=new atributo();
        $tabla=new tabla();
        $form=new formulario();
        $idf=$form->traerId($nombre);
      //  var_dump($id_estudio);exit();/////////////////////////////////////////////
        if($id_estudio){
        $estu=new estudio_medico();
        $estudio=$estu->traerFormEstudioId($id_estudio, $idf);
       // var_dump($estudio);exit();
        foreach ($estudio as $key => $value){
            if(strcmp($value->getTipo(),"file")==0){
        
   $exten=explode(".",$value->getValor());
        $ex=end($exten);
        $value->setExtencion($ex);
          if(strcmp($ex,"avi")==0||strcmp($ex,"mp4")==0||strcmp($ex,"wmv")==0||strcmp($ex,"mkv")==0||strcmp($ex,"3gp")==0){
        $princi=$exten[0];
       $nuevo=$princi.".webm";
       $value->setValor($nuevo);
          }    
            }
           $estudios[]=$value;
        }
        }
}

function eliminar(){
    error_reporting(0);
    Session::init();
    $numero=Session::get('numero_estudio');
    $id_user=Session::get("cedula");
    $mensage="";
    $estudio=new estudio_medico();
    $estudio->setId_usuario($id_user);
    $can=$estudio->contarEstudiosPaciente();

    if($_GET['form']){
        $nomb=$_GET['form'];
        $idf=$estudio->traerIdFormEcho($nomb);
        if($estudio->eliminarFormulario($nomb)){ 
            eliminarFormulario($idf);
            $mensage="El formulario se eliminó con éxito"; 
          
        }else{
          $mensage="Ocurrió un error al intentar eliminar el formulario, verifique";  
        }
        
        }else if($_GET['id_est']){
        $id_estudio=$_GET['id_est'];
        if($estudio->eliminarEstudio($id_estudio)){
            if($can>1){ 
                 $carpeta=Ruta."/".$id_user."/".$id_estudio;
        eliminarDirectorio($carpeta);
           }else{
                $carpeta=Ruta."/".$id_user."/"; 
        eliminarDirectorio($carpeta);
           }
           
            cerrar();
            $mensage="El estudio se eliminó con éxito"; 
        }else{
          $mensage="Ocurrió un error al intentar eliminar el estudio, verifique";  
        }
    }else if($_GET['id_pac']){  
        $id_paciente=$_GET['id_pac']; 
          if($estudio->eliminarPaciente($id_paciente)){
           $carpeta=Ruta."/".$id_user."/"; 
        eliminarDirectorio($carpeta);
        cerrar();
            $mensage="El paciente se eliminó con éxito"; 
        }else{
          $mensage="Ocurrio un error al intentar eliminar el paciente, verifique";  
        } 
    }else{
        $mensage="La pagina no está disponible"; 
    }
   header('Location: principal.php?mensage='.$mensage); 
}

function modAtributo(){
    $nomb=$_POST['atributo'];
    $id_att=$_POST['id_attr'];
     $attr=new atributo();
     $attr->setNombre($nomb);
     $attr->setId_attributo($id_att);
     $mensage="";
     $viejo=$attr->devolverNombre($id_att);
     if(strcmp($viejo,$nomb)!=0){
         if($attr->modificarAtributo()){}else{
         $mensage="Error al modificar nombre de atributo. Verifique";
     }
     }
     
         if($_POST['selectortexto']){
              $tabla=new tabla();     
          $resultado=$tabla->traerTablasId($id_att);
           $arreglo=$_POST['selectortexto'];
          $dato=explode(",",$arreglo); 

           foreach ($dato as $value){
               $value=trim($value);
          $ok=false;
           foreach ($resultado as $key => $values) {
               $valu=trim($values->getOpcion());
           if(strcmp($value,$valu)==0){
               $ok=true;
           }   
       }
       if(!$ok){
        $tabla->setId_atributo($id_att);
        $en=end($value);
        if((strcmp($en,",")!=0) || (strcmp($en,"")!=0)){
        $tabla->setOpcion($value);    
        if($tabla->ingresarTabla()){
        $mensage="Los datos se agregaron con éxito";   
       }else{
         $mensage="Error al ingresar los datos. Verifique"; 
       }
        
        }
       
       }
                }
                
       $tabla->setId_atributo($id_att);          
       foreach ($resultado as $key => $values){
          $valu=trim($values->getOpcion()); 
          $posicion_coincidencia = strpos($arreglo, $values->getOpcion());
if ($posicion_coincidencia === false) {
   $tabla->setOpcion($values->getOpcion());
   $tabla->eliminarOpciones();
    }       
      }                        
    }  
       
         $mensage="El atributo se modificò de forma correcta.";
     header("Location: modAtributo.php?mensage=".$mensage);
}

function modNomForm(){
    $nombre=trim($_POST['viejo']);
    $nuevo=trim($_POST['nuevo']);
    $form=new formulario();
     $mensage="";
    $form->setNombre($nombre);
    if($form->modificarNombre($nuevo)){
      $mensage="El nombre se modificó de forma correcta.";   
    }else{
        $mensage="Error al modificar. Verifique"; 
    }   
     header("Location: modNombreForm.php?mensage=".$mensage);
}

