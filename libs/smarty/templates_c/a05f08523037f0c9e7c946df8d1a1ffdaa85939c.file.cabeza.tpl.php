<?php /* Smarty version Smarty-3.1.20, created on 2016-02-19 19:40:20
         compiled from "vistas\cabeza.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1220056c49c39393872-12193095%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a05f08523037f0c9e7c946df8d1a1ffdaa85939c' => 
    array (
      0 => 'vistas\\cabeza.tpl',
      1 => 1455906769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1220056c49c39393872-12193095',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56c49c3944aa27_91340644',
  'variables' => 
  array (
    'apellido' => 0,
    'cedula' => 0,
    'edad' => 0,
    'formularios' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c49c3944aa27_91340644')) {function content_56c49c3944aa27_91340644($_smarty_tpl) {?><link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
 <script src="js/jquery.js" type="text/javascript"></script> 
 <script src="js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
 <script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
    
</script>
 <header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a tabindex="-1" class="navbar-brand" href="index.php">Inicio</a>
        <a tabindex="-1" class="navbar-brand" href="cerrar.php" style="  margin-left: auto; margin-right: auto;">Cerrar</a>

           <a tabindex="-1" class="navbar-brand" href="formularios.php">Formularios</a>         
 
           <form class="navbar-form navbar-right">
        <input type="text" id="service" name="service" class="form-control" placeholder="paciente" >
         <div id="suggestions"></div>
        </form>
 
         <!--   <div style="float: right;" class="navbar-form navbar-right"><font style="color: #fff;">Apellido: <?php echo $_smarty_tpl->tpl_vars['apellido']->value;?>
<br>Cedula : <?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
 <br>Edad : <?php echo $_smarty_tpl->tpl_vars['edad']->value;?>
</font></div>-->

        <div class="navbar-collapse nav-collapse collapse navbar-header">


        <ul class="nav navbar-nav">
              <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Ingresar Datos<b class="caret"></b></a>
           <ul class="dropdown-menu">
          <?php if ($_smarty_tpl->tpl_vars['formularios']->value) {?>
          <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formularios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
               <li class="dropdown">
               <a tabindex="-1" href="formularios.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value->getId_form();?>
& nombre=<?php echo $_smarty_tpl->tpl_vars['value']->value->getNombre();?>
"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['value']->value->getNombre(), 'UTF-8');?>
</a>
         </li>
          <?php } ?>
         <?php }?>
           
         
            </ul>  
        </li>

          <li class="dropdown">
            <a tabindex="-1" href="guardarmultimedia.php">Archivos</a>
          </li>

        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">FormulariosAdmin<b class="caret"></b></a>
           <ul class="dropdown-menu">
              <li><a tabindex="-1" href="crearFormulario.php">Crear Formularios</a></li>
              <li><a tabindex="-1" href="nuevaVersion.php">Nueva Version Formulario</a></li>
              <li><a tabindex="-1" href="atrapar.php">Ingresar Atributos</a></li>
            </ul>  
        </li>
        <li class="dropdown">
            <a tabindex="-1" href="comentarios.php">Comentarios</a>
          </li>
           <li class="dropdown">
            <a tabindex="-1" href="imprimir.php">Ver Ficha</a>
          </li>
        </ul>
        
      </div> <!-- .nav-collapse -->
    </div> <!-- .container -->
  </header> <!-- .navbar --><?php }} ?>
