<?php /* Smarty version Smarty-3.1.20, created on 2016-03-28 03:28:24
         compiled from "vistas\cabeza.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1091256c797902625a7-76210626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71161a5a317e197260dadd7216af4f389faab762' => 
    array (
      0 => 'vistas\\cabeza.tpl',
      1 => 1459128501,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1091256c797902625a7-76210626',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56c797902dc6c4_04552139',
  'variables' => 
  array (
    'operador' => 0,
    'nick' => 0,
    'cedula' => 0,
    'apellido' => 0,
    'edad' => 0,
    'formularios' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c797902dc6c4_04552139')) {function content_56c797902dc6c4_04552139($_smarty_tpl) {?><link href="css/bootstrap.css" rel="stylesheet" type="text/css">
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
      <?php if (isset($_smarty_tpl->tpl_vars['operador']->value)) {?>  
        <div id="cuadrado" class="nav navbar-nav navbar-left">
    <font style="font-weight: bold;">        
        <font style="color: #fff;">
        Usuario: <?php echo $_smarty_tpl->tpl_vars['nick']->value;?>
</font><br>
    <a tabindex="-1" class="navbar-brand" href="cerrarSesion.php">Cerrar sesion</a>
        </div>
        <?php }?>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php if (!isset($_smarty_tpl->tpl_vars['operador']->value)) {?>
      <a tabindex="-1" class="navbar-brand" href="manual.php">Manual del sitio</a>
      <?php }?>
       
        <a tabindex="-1" class="navbar-brand" href="index.php">Ingreso</a>       
       <?php if (isset($_smarty_tpl->tpl_vars['operador']->value)) {?>
        <a tabindex="-1" class="navbar-brand" href="ingresar.php">Pagina Principal</a> 
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['operador']->value=="admin") {?>
        <a tabindex="-1" class="navbar-brand" href="registrarUsuario.php">Registrar Usuario</a> 
        <?php }?>
        
     <?php if (isset($_smarty_tpl->tpl_vars['cedula']->value)) {?>
           
           <div id="cuadrado" class="nav navbar-nav navbar-right">
    <font style="font-weight: bold;">        
        <font style="color: #fff;">
        Paciente<br>
        Apellido: <?php echo $_smarty_tpl->tpl_vars['apellido']->value;?>
<br>Cedula : <?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
</font><br>
    <a tabindex="-1" class="navbar-brand" href="cerrar.php">Cambiar Paciente</a>
 </div>
  
        <?php }?>
           <form class="navbar-form navbar-right">
        <div class="form-group">  
                         <div class="col-lg-10">
         <input type="text" id="service" name="service" class="form-control" placeholder="cedula paciente" >
                                 </div>
                          </div>        
  <div id="suggestions"><font style="color:white;"></font></div>
        </form>
 
         <!--   <div style="float: right;" class="navbar-form navbar-right"><font style="color: #fff;">Apellido: <?php echo $_smarty_tpl->tpl_vars['apellido']->value;?>
<br>Cedula : <?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
 <br>Edad : <?php echo $_smarty_tpl->tpl_vars['edad']->value;?>
</font></div>-->
</div> <!-- .container -->
        <div class="navbar-collapse nav-collapse collapse navbar-header">


       <ul class="nav navbar-nav">
            <?php if ($_smarty_tpl->tpl_vars['operador']->value=="comun"||$_smarty_tpl->tpl_vars['operador']->value=="admin") {?> 
              <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Formularios <b class="caret"></b></a>
           <ul class="dropdown-menu">
          <?php if ($_smarty_tpl->tpl_vars['formularios']->value) {?>
          <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formularios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
               <li class="dropdown">
                   <a tabindex="-1" href="formularios.php?nombre=<?php echo $_smarty_tpl->tpl_vars['value']->value->getNombre();?>
"> <font style="font-weight: bold;"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['value']->value->getNombre(), 'UTF-8');?>
</font></a>
         </li>
          <?php } ?>
         <?php }?>
            </ul> 
        </li>
          <li class="dropdown">    
           <a tabindex="-1" href="modificarPerfil.php">Modificar Datos Perfil</a>
            </li>
            
         <!--   <li class="dropdown">    
           <a tabindex="-1" href="#">Paginado</a>
            </li>-->
        <?php }?>
       <?php if ($_smarty_tpl->tpl_vars['operador']->value=="admin") {?>   
        <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Administrar Formularios<b class="caret"></b></a>
           <ul class="dropdown-menu">
      <font style="font-weight: bold;"><li><a tabindex="-1" href="crearFormulario.php">Crear Formularios</a></li>
              <li><a tabindex="-1" href="nuevaVersion.php">Nueva Version Formulario</a></li>
              <li><a tabindex="-1" href="atrapar.php">Crear Atributo</a></li>
              <li><a tabindex="-1" href="depende.php">Dependencia Formulario</a></li></font>
            </ul> 
        </li>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['cedula']->value)) {?>
               <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Ver Fichas<b class="caret"></b></a>
           <ul class="dropdown-menu">
         <li class="dropdown">   
     <a tabindex="-1" href="exportarExcel.php">Como tablas en EXCEL</a>
            </li>
             <li class="dropdown">    
     <a tabindex="-1" href="exportarExcel1.php">Como hojas en EXCEL</a>
            </li>
           </ul>  
        </li>
            
            
            
            
              
        <?php }?>
        </ul>
        
      </div> <!-- .nav-collapse -->
    
  </header> <!-- .navbar --><?php }} ?>
