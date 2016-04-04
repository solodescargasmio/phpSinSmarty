<?php /* Smarty version Smarty-3.1.20, created on 2016-03-24 03:19:48
         compiled from "vistas\verFormularios.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2725856f32476a7d8c0-90515245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4a50fc70141365c7d591c2d34ea54f73fb8655f' => 
    array (
      0 => 'vistas\\verFormularios.tpl',
      1 => 1458785985,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2725856f32476a7d8c0-90515245',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56f32476dd40a2_87451266',
  'variables' => 
  array (
    'titulo' => 0,
    'cedula' => 0,
    'nombreform' => 0,
    'estudios' => 0,
    'estudio' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56f32476dd40a2_87451266')) {function content_56f32476dd40a2_87451266($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>

</head>

<body>
    <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid" style="position: absolute;top: 25%;">
 
        <div id="respuestauser"></div>
       <?php if (is_null($_smarty_tpl->tpl_vars['cedula']->value)) {?>
           <h4>
               <font style="color: red;font-weight: bold;">Debe ingresar un paciente nuevo en el formulario "PACIENTE", <br>
               seleccionar un paciente de la lista ó buscar ID de un paciente en la caja que dice 'cedula paciente'</font></h4>
       <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="window.location='ingresar.php'">Atras</button>
    </div>
           <?php } else { ?>
  
           <h2><legend><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['nombreform']->value, 'UTF-8');?>
</legend></h2>

        <?php  $_smarty_tpl->tpl_vars['estudio'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['estudio']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['estudios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['estudio']->key => $_smarty_tpl->tpl_vars['estudio']->value) {
$_smarty_tpl->tpl_vars['estudio']->_loop = true;
?>
            <div class="form-group">
                <label for="nombre" class="col-lg-2 control-label"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo(), 'UTF-8');?>
</label>
    <div class="col-lg-offset-2 col-lg-10">
        <?php if ($_smarty_tpl->tpl_vars['estudio']->value->getTipo()=="file") {?>
            <div class="encuadro">
        <?php if ($_smarty_tpl->tpl_vars['estudio']->value->getExtencion()=="avi"||$_smarty_tpl->tpl_vars['estudio']->value->getExtencion()=="mp4"||$_smarty_tpl->tpl_vars['estudio']->value->getExtencion()=="wmv"||$_smarty_tpl->tpl_vars['estudio']->value->getExtencion()=="mkv"||$_smarty_tpl->tpl_vars['estudio']->value->getExtencion()=="3gp") {?>
  
            <video width="250" height="120" controls>
  <source src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
" type="video/webm">
Tu navegador no soporta este tipo de video.
</video>   
        <?php } elseif ($_smarty_tpl->tpl_vars['estudio']->value->getExtencion()=="png") {?>
   <img src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
" width="250" height="120">
        <?php } else { ?>
            Tu navegador no soporta la visualizacion de este tipo de archivo.
      <img src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
" width="250" height="120">      
        <?php }?>
        <a class="btn btn-primary btn-lg btn-block" href="descargas.php?archivo=<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo();?>
& extension=<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getExtencion();?>
">Descargar</a>
        </div>
        <?php }?>
        
      <legend><?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
</legend>
        </div>
  </div>
            <?php } ?>
<?php }?>
    </div>
   

  <div id="fechatpl">
 <?php echo $_smarty_tpl->getSubTemplate ("fecha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div>
</body>

</html><?php }} ?>
