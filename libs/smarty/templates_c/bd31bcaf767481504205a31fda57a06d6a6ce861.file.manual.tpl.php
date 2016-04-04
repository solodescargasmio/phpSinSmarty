<?php /* Smarty version Smarty-3.1.20, created on 2016-03-28 03:28:24
         compiled from "vistas\manual.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2683856f887d46acfc2-68628458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd31bcaf767481504205a31fda57a06d6a6ce861' => 
    array (
      0 => 'vistas\\manual.tpl',
      1 => 1459128407,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2683856f887d46acfc2-68628458',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56f887d4764174_10729695',
  'variables' => 
  array (
    'titulo' => 0,
    'mensage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56f887d4764174_10729695')) {function content_56f887d4764174_10729695($_smarty_tpl) {?><!DOCTYPE html>
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
    <script src="bootstrap-hover-dropdown.js"></script>
   <script src="js/formToWizard.js" type="text/javascript"></script>
   <script src="js/jquery.js" type="text/javascript"></script>
   <script type="text/javascript">
        $(function(){
	//Aqui se coge el elemento y con la propiedad .on que requiere dos  parametros : change (cuando el valor de ese id cambie, que es cuando se elige otra opcion en la desplegable)y ejecutar la siguiente funcion cuando se haga change
	$("#user").on('blur', function(){
            var id=$(this).val();
     datatypo='admin='+id;//genero un array con indice
             $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#respuestauser").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     }); 
      
    });  
           //  datatypo='user='+user;//genero un array con indice
      
    });
    
   </script>
</head>

<body>
   
    
    <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid">
   <embed src="./imagenes/manual.pdf" style="width: 100%;height: 100%;"><div class="muestro">

        </div>   
    
        
   
       <?php if (isset($_smarty_tpl->tpl_vars['mensage']->value)) {?><font style="color: red;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['mensage']->value;?>
<?php }?></font>  
    </div>
 
</body>

</html><?php }} ?>
