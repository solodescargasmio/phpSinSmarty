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
 <font style="font-weight: bold;">  <div class="container-fluid" style="background: #fff; opacity: 0.8; height: 100%;">
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
                    <input type="submit" value="<<Ingresar nuevo paciente>>" class="form-control btn btn-primary" onClick="window.location='formularios.php?nombre=paciente'">
                    
                    <h3><font style="color: #000;">Proyecto Final Estudios Medicos</h3>
                    <legend>Pacientes en Sistema</legend></font>
      <div class="form-group">
    <label for="nombre" class="col-lg-2 control-label">Seleccione cedula del paciente con el cual va a trabajar </label>
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
              ?>
        <option value="<?php echo $usuario->getValor(); ?>"><?php echo $usuario->getValor(); ?></option>
        <?php } }?>
        

    <?php }?>
        </select>
    </div>
  </div>
        <?php }else{    
            ?>
          <select id="elejir"> 
              <option value="<?php echo $cedula ?>">Ver avances</option>
              <option value="<?php echo $cedula ?>"><?php echo $cedula ?></option>

        </select> 
          
       <?php } ?>
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
    });
    </script>
</body>

</html>