<?php /* Smarty version Smarty-3.1.20, created on 2016-03-29 20:40:58
         compiled from "vistas\formularios.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2749356c8a84b9c6719-18344112%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1048d2f8945db8dbd36e695959e4f078065593cb' => 
    array (
      0 => 'vistas\\formularios.tpl',
      1 => 1459269549,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2749356c8a84b9c6719-18344112',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56c8a84bd59f87_24299369',
  'variables' => 
  array (
    'titulo' => 0,
    'cedula' => 0,
    'nombreform' => 0,
    'ok' => 0,
    'mensage' => 0,
    'estudios' => 0,
    'atributos' => 0,
    'atributo' => 0,
    'tablas' => 0,
    'opcion' => 0,
    'estudio' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c8a84bd59f87_24299369')) {function content_56c8a84bd59f87_24299369($_smarty_tpl) {?><!DOCTYPE html>
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
             $.datepicker.regional['es'] = {
         closeText: 'Cerrar',
         prevText: '<Ant',
         nextText: 'Sig>',
         currentText: 'Hoy',
         monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
         dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
         dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
         dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
         weekHeader: 'Sm',
         dateFormat: 'dd-mm-yy',
         firstDay: 1,
         isRTL: false,
         showMonthAfterYear: false,
         yearSuffix: ''
         };
     $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
    $(".datepicker").datepicker(
        {
        firstDay: 1,
        onSelect: function (date) {
        },
        });

});

       $(document).ready(function(){
           $("#fechatpl").hide();
  var form=document.getElementById("nomformulario").value;
           if(form=="paciente"){
           $("#id_paciente").keyup(function(){  
               con=0;
            var id=$(this).val();
            if(id=="."||id==","||id==""){
        alert("No utilice PUNTOS, COMAS o GUIONES EJ:12345678");
        return;
        }     
    });      
               
          $('input[name=id_paciente]').attr('placeholder','Solo numeros, NO ingrese puntos(.), comas(,) o guiones(_-) EJ:123 ');
       
               $(function(){
	//Aqui se coge el elemento y con la propiedad .on que requiere dos  parametros : change (cuando el valor de ese id cambie, que es cuando se elige otra opcion en la desplegable)y ejecutar la siguiente funcion cuando se haga change
	$("#id_paciente").on('blur', function(){
            var id=$(this).val();
     datatypo='user='+id;//genero un array con indice
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
        
        }else{
        $('input[name=id_paciente]').attr('readonly','readonly');
        }
           
            if($('input[name=altura]').length > 0){  //compruebo que el elemento existe       
   $('input[name=altura]').attr('placeholder','Con punto(.) EJ: 1.60, NO introdusca comas(,) ');
     }
      
        
  $('input[name=edad]').click(function(){
           var value=document.getElementById("datepicker").value;
          var dato=calcular_edad(value);
          document.getElementById("edad").value=dato;
    });
     if($('input[name=fecha_estudio]').length > 0){  //compruebo que el elemento existe       
   fecha_es();
     }
        $("#altura").blur(function(){
        var peso=document.getElementById("peso").value; 
        if(peso==""){
            alert("Por favor, rellene el campo peso");
        }else{  
        var altura=document.getElementById("altura").value;
        var imc=calcular_imc(peso,altura);
        document.getElementById("imc").value=imc.toFixed(2);
        }
    });
    
    
    
    });

    function fecha_es(){
       var fechaActual = new Date();
       var diaActual = fechaActual.getDate();
var mmActual = fechaActual.getMonth() + 1;
var yyyyActual = fechaActual.getFullYear();
    if(diaActual<10){
        var datof="0"+diaActual+"-"+mmActual+"-"+yyyyActual;
    }else
    if(mmActual<10)
    {
         var datof=diaActual+"-0"+mmActual+"-"+yyyyActual;
    }
    else
    if(mmActual<10 && diaActual<10)
    {
         var datof="0"+diaActual+"-0"+mmActual+"-"+yyyyActual;
    }
    
  //var datof=diaActual+"-"+mmActual+"-"+yyyyActual;
           document.getElementById("datepicker").value=datof;
     
        
    }
    
    function calcular_imc(peso,altura){
        var $indice=peso/(altura*altura);
        return $indice;
    }
    
    function calcular_edad(fecha) {
var fechaActual = new Date()
var diaActual = fechaActual.getDate();
var mmActual = fechaActual.getMonth() + 1;
var yyyyActual = fechaActual.getFullYear();
FechaNac = fecha.split("-");
var diaCumple = FechaNac[0];
var mmCumple = FechaNac[1];
var yyyyCumple = FechaNac[2];
//retiramos el primer cero de la izquierda
if (mmCumple.substr(0,1) == 0) {
mmCumple= mmCumple.substring(1, 2);
}
//retiramos el primer cero de la izquierda
if (diaCumple.substr(0, 1) == 0) {
diaCumple = diaCumple.substring(1, 2);
}
var edad = yyyyActual - yyyyCumple;

//validamos si el mes de cumpleaños es menor al actual
//o si el mes de cumpleaños es igual al actual
//y el dia actual es menor al del nacimiento
//De ser asi, se resta un año
if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
edad--;
}
return edad;
};

</script> 
</head>

<body>
    <?php echo $_smarty_tpl->getSubTemplate ("cabeza.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="container-fluid" style="position: absolute;top: 25%;">
 
        <div id="respuestauser"></div>
       <?php if (is_null($_smarty_tpl->tpl_vars['cedula']->value)&&$_smarty_tpl->tpl_vars['nombreform']->value!="paciente") {?>
           <h4>
               <font style="color: red;font-weight: bold;">Debe ingresar un paciente nuevo en el formulario "PACIENTE", <br>
               seleccionar un paciente de la lista ó buscar ID de un paciente en la caja que dice 'cedula paciente'</font></h4>
       <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="window.location='ingresar.php'">Atras</button>
    </div>
           <?php } elseif ($_smarty_tpl->tpl_vars['ok']->value==false) {?>
            <font style="color: red;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['mensage']->value;?>
</font> 
             <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="window.location='ingresar.php'">Atras</button>
    </div>
       <?php } elseif (!isset($_smarty_tpl->tpl_vars['estudios']->value)) {?>
           
           <form style="width: 500px;" role="form" method="POST" enctype="multipart/form-data">
            
            <fieldset><legend><?php if (isset($_smarty_tpl->tpl_vars['nombreform']->value)) {?><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['nombreform']->value, 'UTF-8');?>
<?php }?></legend></fieldset>
            <input type="text" name="nomformulario" value="<?php echo $_smarty_tpl->tpl_vars['nombreform']->value;?>
" id="nomformulario" hidden="">
            <?php if (isset($_smarty_tpl->tpl_vars['atributos']->value)) {?>
                <?php  $_smarty_tpl->tpl_vars['atributo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['atributo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['atributos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['atributo']->key => $_smarty_tpl->tpl_vars['atributo']->value) {
$_smarty_tpl->tpl_vars['atributo']->_loop = true;
?>
                    <div class="form-group" style="border-width: 10px; background:#C8C0C0;">
    <label for="nombre" class="col-lg-2 control-label"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['atributo']->value->getNombre(), 'UTF-8');?>
:</label>
    <div class="col-lg-10">
          
      <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getTipo()=="double"||$_smarty_tpl->tpl_vars['atributo']->value->getTipo()=="float") {?>
          <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getObligatorio()=="0") {?>
              <input type="text" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" required=""> 
      <?php } else { ?>
           <input type="text" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
"> 
          <?php }?>
        
        <?php } elseif ($_smarty_tpl->tpl_vars['atributo']->value->getTipo()=="text") {?>
           <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getTabla()=="1") {?>
          
            <select name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
">
            
                <?php  $_smarty_tpl->tpl_vars['opcion'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['opcion']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tablas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['opcion']->key => $_smarty_tpl->tpl_vars['opcion']->value) {
$_smarty_tpl->tpl_vars['opcion']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['opcion']->value->getId_atributo()==$_smarty_tpl->tpl_vars['atributo']->value->getId_attributo()) {?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['opcion']->value->getOpcion();?>
"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['opcion']->value->getOpcion(), 'UTF-8');?>
</option>
                    <?php }?>
                  <?php } ?>
               
            </select>
               <?php } elseif ($_smarty_tpl->tpl_vars['atributo']->value->getObligatorio()=="0") {?>
                   <input type="text" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" required="">              
                   <?php } else { ?>    
                  <input type="text" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
"> 
            <?php }?> 
            <?php } elseif ($_smarty_tpl->tpl_vars['atributo']->value->getTipo()=="date") {?>
                <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getObligatorio()=="0") {?>
          <input type="text" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="datepicker" required="">
          <?php } else { ?>
              <input type="text" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="datepicker">
          <?php }?>
                <?php } elseif ($_smarty_tpl->tpl_vars['atributo']->value->getTipo()=="int") {?>
              <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getNombre()=="id_paciente"&&$_smarty_tpl->tpl_vars['nombreform']->value!="paciente") {?>
                  <input type="number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" readonly="">
              <?php } elseif ($_smarty_tpl->tpl_vars['atributo']->value->getObligatorio()=="0") {?>
                  <input type="number" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" required="">
              <?php } else { ?>
                  <input type="number" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
">
              <?php }?>
              
        <?php } elseif ($_smarty_tpl->tpl_vars['atributo']->value->getTipo()=="file") {?>
            <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getObligatorio()=="0") {?>
                <input type="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getTipo();?>
" class="form-control" name="archivo[]" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" required="">
            <?php } else { ?>
                <input type="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getTipo();?>
" class="form-control" name="archivo[]" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
">
            <?php }?>
            
            <?php } else { ?>
             <?php if ($_smarty_tpl->tpl_vars['atributo']->value->getObligatorio()=="0") {?>   
                 <input type="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getTipo();?>
" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" required="">  
            <?php } else { ?>
                <input type="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getTipo();?>
" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
" id="<?php echo $_smarty_tpl->tpl_vars['atributo']->value->getNombre();?>
">  
                <?php }?>
             <?php }?>
    </div>
  </div>
            <?php } ?>
 <?php }?>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Alta Datos</button>
    </div>
  </div>       
        </form>
  
  <?php } else { ?>      
  

 <form style="width: 500px;" role="form" method="POST" enctype="multipart/form-data">   
            <fieldset><legend><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['nombreform']->value, 'UTF-8');?>
</legend></fieldset>
        <?php  $_smarty_tpl->tpl_vars['estudio'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['estudio']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['estudios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['estudio']->key => $_smarty_tpl->tpl_vars['estudio']->value) {
$_smarty_tpl->tpl_vars['estudio']->_loop = true;
?>
            <input type="text" name="nomformulario" value="<?php echo $_smarty_tpl->tpl_vars['nombreform']->value;?>
" id="nomformulario" hidden="">
           <div class="form-group" style="border-width: 10px; background: #C8C0C0;">
                <label for="nombre" class="col-lg-2 control-label"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo(), 'UTF-8');?>
</label>
    <div class="col-lg-offset-2 col-lg-10">
        <?php if ($_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo()=="fecha_nacimiento"||$_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo()=="id_paciente"||$_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo()=="fecha_estudio"||$_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo()=="edad") {?>
            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
" name="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo();?>
" readonly="">
        <?php } elseif ($_smarty_tpl->tpl_vars['estudio']->value->getTipo()=="float"||$_smarty_tpl->tpl_vars['estudio']->value->getTipo()=="double"||$_smarty_tpl->tpl_vars['estudio']->value->getTipo()=="int") {?> 
           <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
" name="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo();?>
" id="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo();?>
">   
        <?php } else { ?>
          <input type="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getTipo();?>
" value="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getValor();?>
" name="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo();?>
" id="<?php echo $_smarty_tpl->tpl_vars['estudio']->value->getNom_attributo();?>
">   
        <?php }?>
        </div>
  </div>
            <?php } ?>
            <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
       <input type="submit" name="modificar" class="btn btn-primary btn-lg btn-block" value="Guardar Modificaciones">
       <br> <a href="ingresar.php" >   <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location:'ingresar.php'">Cancelar Modificacion</button> </a>
    </div>
  </div> 
        </form>
      
    
      
      
 <?php }?>
    </div>
  <div id="fechatpl">
 <?php echo $_smarty_tpl->getSubTemplate ("fecha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div>
</body>

</html><?php }} ?>
