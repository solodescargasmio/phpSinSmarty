<?php /* Smarty version Smarty-3.1.20, created on 2016-03-17 19:45:41
         compiled from "vistas\paginado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:811356e6a0a7baeb95-41141424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd810246ec0696e85aef4496577a81b9f2f7a50d9' => 
    array (
      0 => 'vistas\\paginado.tpl',
      1 => 1458240339,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '811356e6a0a7baeb95-41141424',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56e6a0a7bebc23_96307226',
  'variables' => 
  array (
    'titulo' => 0,
    'atributos' => 0,
    'valor' => 0,
    'actual' => 0,
    'totalpaginas' => 0,
    'limite' => 0,
    'mensage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e6a0a7bebc23_96307226')) {function content_56e6a0a7bebc23_96307226($_smarty_tpl) {?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <link href="css/dashboard.css" rel="stylesheet">
    </head>
        <style type="text/css">
        body { font-family:Lucida Sans, Arial, Helvetica, Sans-Serif; font-size:13px; margin:20px;}
        #main { width:960px; margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:500px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:300px; padding:5px; border:solid 1px #000;}
 
    </style>
  

            <script>
             
$(document).ready(function(){
  $("#llamar").click(function(){
      var response[] =new Array();
      response= "<?php echo $_smarty_tpl->tpl_vars['atributos']->value;?>
";
$.each(response , function( index, obj ) { $.each(obj, function( key, value ) { alert('key + value'); }); }); 
     // alert(ultimoval);
        });
    $('#miform').hide();
  
		$("#mostrar").on( "click", function() {
			$('#miform').show(); //muestro mediante id 
                        
                        $ini=0;
                        dato='inicio='+0;
                        $.ajax({
                          url: "paginador.php",
                          type: 'POST',
                          data: dato,
                          success: function (data) {
                        $("#miform").fadeIn(1000).html(data);
                    }
                        });
                        
                        
                        $('#formversion').hide(); //oculto mediante id 
     
		 });
		$("#ocultar").on( "click", function() {
                         $('#miform').hide();
                          $('#formversion').show(); //muestro mediante id 
		});
  });
    
    function control(){
        nomb_form=document.getElementById("nom_formulario").value;
      datatypo='nom_formulario='+nomb_form;
          $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#avizo").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     });  
    }
     
        </script>
<body>
   <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid">
        <button id="llamar">Llamar</button>
        <div id="menus">
<?php if (isset($_smarty_tpl->tpl_vars['atributos']->value)) {?>
    Cantidad a mostrar <input type="number" id="cant"> 
       <form id="miform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <br> <table class="table-responsive" border="1">  
                <tr>
                  <td>Nombre y tipo Campo :</td>
               </tr>
              
               
               
    <?php  $_smarty_tpl->tpl_vars['valor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['valor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['atributos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['valor']->key => $_smarty_tpl->tpl_vars['valor']->value) {
$_smarty_tpl->tpl_vars['valor']->_loop = true;
?>
              
               <tr class="agregar">
                   <td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="<?php echo $_smarty_tpl->tpl_vars['valor']->value->getNombre();?>
" hidden=""><?php echo $_smarty_tpl->tpl_vars['valor']->value->getNombre();?>

                      &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="<?php echo $_smarty_tpl->tpl_vars['valor']->value->getTipo();?>
" hidden=""><?php echo $_smarty_tpl->tpl_vars['valor']->value->getTipo();?>
</a>
                   <input type="text" name="id_att" class="id_att" value="<?php echo $_smarty_tpl->tpl_vars['valor']->value->getId_attributo();?>
" hidden=""> 
                   </td>                 
                   </tr>
                   <?php } ?>
                 </table> 
                 </form>
                  <br> <p>Pagina:<?php echo $_smarty_tpl->tpl_vars['actual']->value;?>
 /<?php echo $_smarty_tpl->tpl_vars['totalpaginas']->value;?>
</p> 
            <?php if ($_smarty_tpl->tpl_vars['actual']->value<$_smarty_tpl->tpl_vars['totalpaginas']->value&&$_smarty_tpl->tpl_vars['actual']->value==1) {?>
                <a href="crearFormulario.php?ini=<?php echo $_smarty_tpl->tpl_vars['limite']->value;?>
">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a> 
            <?php } elseif ($_smarty_tpl->tpl_vars['actual']->value<$_smarty_tpl->tpl_vars['totalpaginas']->value&&$_smarty_tpl->tpl_vars['actual']->value>1) {?>
            <a href="crearFormulario.php?ini=<?php echo $_smarty_tpl->tpl_vars['limite']->value-3;?>
"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a> ||    
            <a href="crearFormulario.php?ini=<?php echo $_smarty_tpl->tpl_vars['limite']->value;?>
">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>
            <?php } elseif ($_smarty_tpl->tpl_vars['actual']->value==$_smarty_tpl->tpl_vars['totalpaginas']->value&&$_smarty_tpl->tpl_vars['actual']->value>1) {?>
            <a href="crearFormulario.php?ini=<?php echo $_smarty_tpl->tpl_vars['limite']->value-3;?>
"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a>
            <?php } else { ?>
            <a href="#">Actual</a>     
            <?php }?> 
                   
                   <?php } else { ?>
                       <?php echo $_smarty_tpl->tpl_vars['mensage']->value;?>

<?php }?>
</div>
</div>
         
</body>
</html><?php }} ?>
