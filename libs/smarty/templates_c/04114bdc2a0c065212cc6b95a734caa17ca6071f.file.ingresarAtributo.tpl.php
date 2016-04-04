<?php /* Smarty version Smarty-3.1.20, created on 2016-03-28 17:54:24
         compiled from "vistas\ingresarAtributo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:562656c8bb70d1cef1-56969332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04114bdc2a0c065212cc6b95a734caa17ca6071f' => 
    array (
      0 => 'vistas\\ingresarAtributo.tpl',
      1 => 1459180458,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '562656c8bb70d1cef1-56969332',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56c8bb70e11134_82975266',
  'variables' => 
  array (
    'mensage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c8bb70e11134_82975266')) {function content_56c8bb70e11134_82975266($_smarty_tpl) {?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo Atributo</title>
       <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
     <link href="./css/dashboard.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myform2").hide();
             $("#mostrar").hide();
             $("#ocultar").show();
             
                $("#ocultar").click(function(){
                $("#myform1").hide();
                $("#mostrar").show();
                $("#myform2").show();
                $("#ocultar").hide();
            
    });
             
            $("#mostrar").click(function(){
                $("#myform2").hide();
                $("#ocultar").show();
                $("#myform1").show();
                $("#mostrar").hide();     
    });       
 
    });
    
  function vacio(e){
       ok=true;
       patron =/\w/;
       k=e.which;
       if (k==8 || k==0) return true;
       n = String.fromCharCode(k);
return patron.test(n);
 /*if((k < 97 || k > 122) && (k < 65 || k > 90) && (k !== 16||k !== 8||k !== 242)){
       alert("No agrege espacios en blanco ni caracteres raros \n si quiere escribir varias palabras unalas con guión bajo '_'");
ok=false; 
        }
return ok;*/
    }  
    
    </script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid" style="position: absolute;top: 25%;">
        <?php if (isset($_smarty_tpl->tpl_vars['mensage']->value)) {?><?php echo $_smarty_tpl->tpl_vars['mensage']->value;?>
<?php }?>
            <a href="#" onclick="mostrarDiv()" id="att"> <button id="mostrar"  class="btn btn-primary btn-group-sm">Atributo Simple</button></a>
   <a href="#" onclick="mostrarDiv()" id="att1"> <button id="ocultar"  class="btn btn-primary btn-group-sm">Atributo Compuesto </button></a>
   
        <form style="width: 500px;" id="myform1" method="post" enctype="multipart/form-data" class="form-horizontal">                            
          <fieldset>  <label  class="col-sm-4 control-label">Atributo Simple</label></fieldset>
    
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Nombre del atributo</label>
                    <div class="col-sm-8">
                        <input type="text" onkeypress="return vacio(event);" name="nombre" id="nombre" placeholder="Ej: direccion (Sin espacios o caracteres raros)" class="success" size ="50">
                   </div> 
                </div> 
      
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Agregar campo de tipo</label>
                    <div class="col-sm-8">
        <select name="selector">
        <option value="text">text</option>
        <option value="checkbox">checkbox</option>
        <option value="double">double</option>
        <option value="int">int</option>
        <option value="date">date</option>
        <option value="file">file</option>
        </select>
                   </div> 
                </div>   
      <input type="submit" value="Enviar" class="btn btn-primary btn-group-justified">
            </form>
    
        <form style="width: 600px;" id="myform2" method="post" enctype="multipart/form-data" class="form-horizontal">                            
          <fieldset>  <label  class="col-sm-4 control-label">Atributo Compuesto</label></fieldset>
    
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Nombre de la tabla</label>
                    <div class="col-sm-8">
  <input type="text" onkeypress="return vacio(event);" name="nombre" id="nombre" placeholder="Ej: sexo (Sin espacios o caracteres raros)" class="success" size ="50">
                   </div> 
                </div> 
      
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Agregar opciones de atributo</label>
                    <div class="col-sm-8">
                        <textarea name="selectortexto" placeholder="ej: masculino,   femenino"></textarea>
                        <font style="color: red;font-weight: bold;">   Separados por comas (',')</font>
                    </div> 
                </div>   
      <input type="submit" value="Enviar" class="btn btn-primary btn-group-justified">
            </form>
        
      </div>
    </body>
</html><?php }} ?>
