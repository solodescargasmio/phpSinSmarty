<?php /* Smarty version Smarty-3.1.20, created on 2016-03-07 02:34:06
         compiled from "vistas\principal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1324156d63e08e4e1c5-49206679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9988f0f2ffe42f81f04ce9f074a3e85236ed20f' => 
    array (
      0 => 'vistas\\principal.tpl',
      1 => 1457314006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1324156d63e08e4e1c5-49206679',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56d63e0907a129_53164421',
  'variables' => 
  array (
    'titulo' => 0,
    'mensage' => 0,
    'cedula' => 0,
    'usuarios' => 0,
    'usuario' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d63e0907a129_53164421')) {function content_56d63e0907a129_53164421($_smarty_tpl) {?><!DOCTYPE html>
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

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>

<body>
 <font style="font-weight: bold;">  <div class="container-fluid" style="background: #fff; opacity: 0.8; height: 100%;">
    <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  
        <div class="row">
            <?php if (isset($_smarty_tpl->tpl_vars['mensage']->value)) {?>
          <?php echo $_smarty_tpl->tpl_vars['mensage']->value;?>

          <?php }?>
                <?php if (is_null($_smarty_tpl->tpl_vars['cedula']->value)) {?>
                       
                    <input type="submit" value="<<Ingresar nuevo paciente>>" class="form-control btn btn-primary" onClick="window.location='formularios.php?nombre=paciente'">
                    
                    <h3><font style="color: #000;">Proyecto Final Estudios Medicos</h3>
                    <legend>Pacientes en Sistema</legend></font>
      <div class="form-group">
    <label for="nombre" class="col-lg-2 control-label">Seleccione cedula del paciente con el cual va a trabajar </label>
    <div class="col-lg-10">
        <select id="elejir"><option>Seleccione una opcion</option>
            <?php if (isset($_smarty_tpl->tpl_vars['usuarios']->value)) {?>
    <?php  $_smarty_tpl->tpl_vars['usuario'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['usuario']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usuarios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['usuario']->key => $_smarty_tpl->tpl_vars['usuario']->value) {
$_smarty_tpl->tpl_vars['usuario']->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['usuario']->value->getId_attributo()=="1") {?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->getValor();?>
"><?php echo $_smarty_tpl->tpl_vars['usuario']->value->getValor();?>
</option>
           <?php }?>
        <?php } ?>

    <?php }?>
        </select>
    </div>
  </div>
        <?php } else { ?>
            <?php if (isset($_smarty_tpl->tpl_vars['usuarios']->value)) {?>
          <select id="elejir"> 
              <option value="<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
">Ver avances</option>
        <option value="<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
</option>
    <?php }?>
        </select> 
          
       <?php }?>
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

</html><?php }} ?>
