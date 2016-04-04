<?php /* Smarty version Smarty-3.1.20, created on 2016-03-13 18:40:40
         compiled from "vistas\modifPerfil.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1466756e575553567e2-94547641%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c9bd1ecc86de5d1b4e1b83864e535ef32f0ea0a' => 
    array (
      0 => 'vistas\\modifPerfil.tpl',
      1 => 1457890220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1466756e575553567e2-94547641',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56e5755540d990_06124662',
  'variables' => 
  array (
    'titulo' => 0,
    'mensage' => 0,
    'usuario' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e5755540d990_06124662')) {function content_56e5755540d990_06124662($_smarty_tpl) {?><!DOCTYPE html>
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
    <script>
        
    </script> 
</head>

<body>
    <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid" style="position: absolute;top: 120px;">
        <?php if (isset($_smarty_tpl->tpl_vars['mensage']->value)) {?><?php echo $_smarty_tpl->tpl_vars['mensage']->value;?>
<?php }?>
        <div id="respuestauser"></div>
        <?php if (isset($_smarty_tpl->tpl_vars['usuario']->value)) {?><?php }?>
        <form style="width: 500px;" method="POST">
            <fieldset><legend>Mi Perfil</legend></fieldset>   
              <div class="form-group">
                   <label  class="col-sm-4 control-label">Nick</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="text" name="viejo" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->getNick();?>
" hidden="">
        <input type="text" name="nick" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->getNick();?>
">
    </div>
  </div>
            
              <div class="form-group">
        <label  class="col-sm-4 control-label">Nombre</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="text" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->getNombre();?>
"> </div>
  </div>
            
              <div class="form-group">
        <label  class="col-sm-4 control-label">Apellido</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="text" name="apellido" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->getApellido();?>
"></div>
  </div>
            
              <div class="form-group">
          <label  class="col-sm-4 control-label">Email</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->getEmail();?>
"></div>
  </div>
          
               <div class="form-group">
          <label  class="col-sm-4 control-label">Contraseña</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="password" name="passw"></div>
  </div>
            
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Modificar Datos</button>
    </div>
  </div>
            
        </form>
 
    </div>
</body>

</html><?php }} ?>
