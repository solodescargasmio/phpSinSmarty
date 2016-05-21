<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudios Médicos||Principal</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>

<body>
  
 <font style="font-weight: bold;">  <div class="container-fluid" style="background: #AEABAB; height: 100%;">
   <?php include 'cabezal.php'; ?>
        <div class="row">
         <?php
         error_reporting(0);
         require_once ('./clases/atributo.php');
require_once ('./clases/formulario.php');
require_once ('./clases/form_attr.php');
require_once ('./clases/session.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/datosPrecargados.php');
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php }
    
      $id_user=Session::get('cedula');
      $cedula=$id_user;
      $form=new formulario();
      $attr1=new atributo();
        if (is_null($cedula)){
     ?>   
 
                    <h3><font style="color: #000;">Proyecto Final Estudios Medicos</h3>
                    <br>    
                     <input type="submit" value="<<Ingresar nuevo paciente>>" class="btn btn-primary" onClick="window.location='llenarFormularios.php?nombre=paciente'">              
                     <br><br>     
                    <legend>Pacientes en Sistema</legend></font>
      <div class="form-group">
    <label for="nombre" class="col-lg-2 control-label">Seleccione cedula del paciente con el cual va a trabajar o click en la LUPA arriba a la derecha</label>
    <div class="col-lg-10">
        <select id="elejir"><option>Seleccione una opcion</option>
           <?php 
            $estudio=new estudio_medico();
    $estud=$estudio->traerPacientes(); 
      if($estud!=null){
          foreach ($estud as $keys => $values) {
              $usuarios[]=$values;//guardo todos los formularios dinamicos para mostrarlos en cabeza.tpl
              }
          }
          if(isset($usuarios)){
              foreach ($usuarios as $key => $usuario) {  
           if($usuario->getId_attributo()==1){
               if(strcmp($valor,$usuario->getValor())==0){}else{
              ?>
        <option value="<?php echo $usuario->getValor(); ?>"><?php echo $usuario->getValor(); ?></option>
               <?php $valor=$usuario->getValor(); } }}?>
        

    <?php }?>
        </select>
    </div>
  </div>
        <?php }else{        
     $id_paciente=$cedula;
                 $attr=new atributo();
                 $formula=new formulario();
                 $resul=$formula->traerFormularios();
                 $estudio=new estudio_medico();
                 $estudio->setId_usuario($id_paciente);
                 $ca=$estudio->contarEstudiosPaciente();
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
            
       } ?>
        <div id="respuestauser"></div>
   </div>
   </div>
          <script src="bootstrap-hover-dropdown.js"></script>
  <script src="js/formToWizard.js" type="text/javascript"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
        $(function(){
	//Aqui se coge el elemento ciudad y con la propiedad .on que requiere dos  parametros : change (cuando el valor de ese id cambie, que es cuando se elige otra opcion en la desplegable)y ejecutar la siguiente funcion cuando se haga change
	$('#elejir').on('change', function(){
              user=$('#elejir').val();
                datatypo='idtraer='+user;//genero un array con indice
     $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#respuestauser").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     });     
    });  
    
//    $('#elejir1').on('change', function(){
//              user=$('#elejir1').val();
//                datatypo='idtraers='+user;//genero un array con indice
//     $.ajax({
//         url: 'controlarAjax.php',//llamo a la pagina q hace el control
//         type:'POST',//metodo por el cual paso el dato
//         data:datatypo,
//             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
//                  $("#respuestauser").fadeIn(1000).html(data); //imprimo el mensaje en el div      
//                
//    }
//     });     
//    }); 
    });
    </script>
    <?php include 'footer.php';?>
</body>

</html>