<?php
session_start(); 
?>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
 <script src="js/jquery.js" type="text/javascript"></script> 
 <script src="js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
  <script type="text/javascript">
  $(document).ready(function() {  
      $('#suggestions').hide();//oculto el div que muestra las opciones que vá encontrando
    //Al escribr dentro del input con id="service"
    $('#service').keyup(function(){
        //Obtenemos el value del input
        largo=1;
    
        var service = $(this).val();
        if(service.length>largo){
         var dataString = 'service='+service;   
    
        
         
        //Le pasamos el valor del input al ajax
        $.ajax({
            type: "POST",
            url: "autocompletar.php",
            data: dataString,
            success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions').fadeIn(1000).html(data);
                //Al hacer click en algua de las sugerencias
                var id="";
                $('a').on('click', function(){
                    //Obtenemos la id unica de la sugerencia pulsada
                    id= $(this).attr('id') ;

                    //Editamos el valor del input con data de la sugerencia pulsada
                    $('#service').val($('#'+id).attr('data')); 
       /////////////////////////////////////////////////////////////
       //de aca hasta las lineas de abajo es lo mismo que uso en principal
                      datatypo='idtraer='+id;//genero un array con indice
     $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#respuestauser").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
   $("#lupa").show();
       $("#desplegar").hide();
    }
     });  
    /////////////////////////////////////////////////////////////   
//  $('#service').val($('#'+id).attr('data'));
                    //Hacemos desaparecer el resto de sugerencias
         
                   $('#suggestions').fadeOut(1000);
                  //  window.location='index.php?idpaciente='+id;
                });              
            }
        });}else{ $('#suggestions').fadeOut(1000);
    }
    }); 
    
    $("#desplegar").hide();
  
}); 
$(function(){
    $("#lupa").on('click',function(){
        $("#lupa").hide();
       $("#desplegar").show(); 
    });
});

   </script>
  <style>
.suggest-element{
    
margin-left:5px;
margin-top:5px;
width:350px;
cursor:pointer;
}
#suggestions {

width:350px;
height:150px;
overflow: auto;
}
</style>
 
 <script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
    
</script>
 <header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
    <?php 
    require_once ('./clases/estudio_medico.php');
  require_once ('./clases/atributo.php');
  require_once ('./clases/formulario.php');
  require_once ('./clases/form_attr.php');
  require_once ('./clases/session.php');
     $nick=  Session::get("nick");
     $operador=Session::get("usuario");
     $cedula=Session::get("cedula");
     if(isset($nick)){
    ?>
        <div id="cuadrado" class="nav navbar-nav navbar-left">
   
            <font style="font-weight: bold;">        
        <font style="color: #fff;">
        Usuario: <?php echo $nick; ?></font><br>
    <a tabindex="-1" class="navbar-brand" href="cerrarSesion.php">Cerrar Sesión</a>
        </div>
        <?php }; ?>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <?php
     if(!isset($nick)){
    ?>
      <a tabindex="-1" class="navbar-brand" href="manual.php">Manual de Usuario</a>
       <a tabindex="-1" class="navbar-brand" href="cerrarSesion.php">Ingreso</a> 
     <?php }; ?>
       <a tabindex="-1" class="navbar-brand" href="#"></a> 
       <a tabindex="-1" class="navbar-brand" href="#"></a> 
             
        <?php
     if(isset($nick)){ ?>
        <a tabindex="-1" class="navbar-brand" href="principal.php">Página Principal</a> 
        <?php }; 
       if(strcmp($operador,"admin")==0){ ?>
        <a tabindex="-1" class="navbar-brand" href="registrar.php">Registrar Usuario</a> 
        <?php };
        if (isset($cedula)){
         $apell= Session::get('apellido');
    $edad=  Session::get('edad');     
        ?>
           <div id="cuadrado" class="nav navbar-nav navbar-right">
    <font style="font-weight: bold;">        
        <font style="color: #fff;">
        Paciente<br>
        Apellido:<?php echo $apell; ?><br>Cedula : <?php echo $cedula; ?></font><br>
    <a tabindex="-1" class="navbar-brand" href="cerrar.php">Cambiar Paciente</a>
 </div>
   <?php }; ?>
        <a href="#"><img src="imagenes/buscar.png" id="lupa" style="float: right; width: 8%;height: 8%;">
        </a>
        <div id="desplegar">
           <form class="navbar-form navbar-right">
        <div class="form-group">  
                         <div class="col-lg-10">
         <input type="text" id="service" name="service" class="form-control" placeholder="cédula paciente" >
                                 </div>
                          </div>        
  <div id="suggestions"><font style="color:white;"></font></div>
        </form>
 </div>
         <!--   <div style="float: right;" class="navbar-form navbar-right"><font style="color: #fff;">Apellido: {$apellido}<br>Cedula : {$cedula} <br>Edad : {$edad}</font></div>-->
</div> <!-- .container -->
        <div class="navbar-collapse nav-collapse collapse navbar-header">


       <ul class="nav navbar-nav">
           <?php if((strcmp($operador,"comun")==0)||(strcmp($operador,"admin")==0)){?> 
              <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Formularios <b class="caret"></b></a>
           <ul class="dropdown-menu">
               <?php 
               $form=new formulario();
            $resultado=$form->traerFormularios();//obtengo todos los forms 
    //"Esto lo hago en todas las funciones para que cabeza.tpl siempre tenga los forms"
//    if($resultado!=null){
//          foreach ($resultado as $key => $value) {
//               var_dump($value->getNombre());
//         $formularios[]=$value;//guardo todos los formularios dinamicos para mostrarlos en cabeza.tpl
//              }        
//          }   
//         
          if($resultado){
              foreach ($resultado as $key => $value) {
                  $dat=$value->traerCantidad(); ?>
      <li class="dropdown">
   <a tabindex="-1" href="llenarFormularios.php?nombre=<?php echo $value->getNombre();?>"> <font style="font-weight: bold;"><?php echo strtoupper($value->getNombre());?></font></a>              
               <!--  <a tabindex="-1" href="llenarFormularios.php?nombre=<?php echo $value->getNombre();?>"> <font style="font-weight: bold;"><?php echo strtoupper($value->getNombre());?></font></a>-->
         </li>       
         <?php      }   
          }
          ?>
             
         
            </ul> 
        </li>
          <li class="dropdown">    
           <a tabindex="-1" href="modifPerfil.php">Modificar Mi Perfil</a>
            </li>
            
         <!--   <li class="dropdown">    
           <a tabindex="-1" href="#">Paginado</a>
            </li>-->
        <?php }
       if(strcmp($operador,"admin")==0){ ?>  
        <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Administrar Formularios<b class="caret"></b></a>
           <ul class="dropdown-menu">
      <font style="font-weight: bold;"><li>
          <a tabindex="-1" href="crearFormularios.php">Crear Formularios</a></li>
              <li><a tabindex="-1" href="version.php">Nueva Versión Formulario</a></li>
              <li><a tabindex="-1" href="modNombreForm.php">Modificar Nombre Formulario</a></li>
              <li><a tabindex="-1" href="ingatributos.php">Crear Atributo</a></li>
              <li><a tabindex="-1" href="modAtributo.php">Modificar Atributos</a></li>
              <li><a tabindex="-1" href="dependencia.php">Dependencia Formulario</a></li>
              </font>
            </ul> 
        </li>
   
   
         <?php }
        if(isset($cedula)){
         ?> 
        
               <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Ver Fichas<b class="caret"></b></a>
           <ul class="dropdown-menu"><font style="font-weight: bold;">
         <li class="dropdown">   
     <a tabindex="-1" href="exportarExcel.php">Como tablas en EXCEL</a>
            </li>
             <li class="dropdown">    
     <a tabindex="-1" href="exportarExcel1.php">Como hojas en EXCEL</a>
            </li>
            </font> </ul>  
        </li>
           <li class="dropdown">    
               <a tabindex="-1" href="eliminar.php">Eliminar</a>
            </li>
 <?php } ?> 
        </ul>
        
      </div> <!-- .nav-collapse -->
    
  </header> <!-- .navbar -->