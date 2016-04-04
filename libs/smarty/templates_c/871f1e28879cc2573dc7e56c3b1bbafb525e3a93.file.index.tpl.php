<?php /* Smarty version Smarty-3.1.20, created on 2016-02-19 19:27:32
         compiled from "vistas\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1807456c49bd357bcf5-48682141%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '871f1e28879cc2573dc7e56c3b1bbafb525e3a93' => 
    array (
      0 => 'vistas\\index.tpl',
      1 => 1455906449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1807456c49bd357bcf5-48682141',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56c49bd3764178_29199852',
  'variables' => 
  array (
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c49bd3764178_29199852')) {function content_56c49bd3764178_29199852($_smarty_tpl) {?><!DOCTYPE html>
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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>

<body>
    <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid" style="position: absolute;top: 120px;">
         <h1>Bonjur measie. Aime cer si</h1>
        <a href="agregarAtributos.php">Agregar nuevo atributo</a>||
        <a href="crearFormulario.php">Crear Formulario</a>
        
    </div>
</body>

</html><?php }} ?>
