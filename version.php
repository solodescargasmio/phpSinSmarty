<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Verionar Formularios</title>
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
    $('#miform').hide();
  
		$("#mostrar").on( "click", function() {
                    dat=document.getElementById("nom_formulario").value;
    if(dat==""){
        alert("Elija un formulario de la tabla. Gracias");
        }else {
			$('#miform').show(); //muestro mediante id 
                        $('#formversion').hide(); //oculto mediante id 
     
		} });
		$("#ocultar").on( "click", function() {
                         $('#miform').hide();
                          $('#formversion').show(); //muestro mediante id 
		});
    });
 
     
        </script>
                <script>
          $(function() {
            var $fieldset = $('<fieldset>');    
    var $form = $("#my-dynamic-form");
    $(' <div class="form-group">'+
                 '<label  class="col-sm-8 control-label">Nombre Formulario(*)</label>'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="text" name="nom_formulario" id="nom_formulario" onblur="control();" required="" readonly>').appendTo($fieldset);
      $('</div></div><div id="poner"></div>').appendTo($fieldset); 
         $(' <div class="form-group">'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="submit" value="Guardar Formulario" ident="guardo" id="guardo" class="btn btn-primary btn-group-justified">').appendTo($fieldset);
      $('</div></div>').appendTo($fieldset); 
        $fieldset.appendTo($form); 
    $('.campo1').click( function(){
            var $dato= $(".campo",this).val();
            var $dato1= $(".valor",this).val();
            var $id_att=0;
            $id_att=$(".ids",this).val();
       da=recorrerDom($dato);
       if(da==0){ //si son distintos lo agrego
           gu="guardo";
           $("#my-dynamic-form input").remove("#"+gu+""); 
        $(' <div class="form-group" id="'+ $dato +'">'+
                 '<label  class="col-sm-8 control-label">'+ capitalize($dato) +'</label>'+
    '<div class="col-lg-10">'+
        '<input type="text" id="'+ $dato +'" name="'+ $dato +'" value="'+ $dato1 +'" readonly=>'+
            '<input type="button" id="'+ $dato +'" value="-" style="color: red;" name="eliminar" ident="'+ $dato +'" onclick="eliminarElementoDom('+$id_att+')">Obligatorio<input type="checkbox" id="'+ $id_att +'" name="'+ $id_att +'"></div></div>').appendTo($fieldset);  
            $(' <div class="form-group">'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="submit" value="Guardar Formulario" ident="guardo" id="guardo" class="btn btn-primary btn-group-justified">').appendTo($fieldset);
      $('</div></div>').appendTo($fieldset);    
    $fieldset.appendTo($form);}
    else{ //si son iguales mando el alert e impido que un boludo ingrese dos veces el mismo atributo
        alert('El atributo que intenta agregar, ya existe en el formulario.');
    }
       $("html, body").animate({scrollTop: 0}, 1000);     
    });
 
}); 
$(function(){
    $('.version1').click( function(){
        
            var $dato1= $(".formular",this).val();
        document.getElementById("nom_formulario").value=$dato1; 
     nomb_form=$dato1; //document.getElementById("nom_formulario").value;
      datatypo='formulario='+nomb_form;
         $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#poner").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     });
    });
    });
    
     function control(){

     
 }
    
    
    
 function recorrerDom(valor) { 
    va=0;
    //recorro todos los label y si alguno tiene el mismo texto no le permito ingresar el atributo
        $("#my-dynamic-form label").each(function (idx, el){
  //$(el).html() aca obtengo el texto en los labels que estan en mayuscula
  //capitalize(valor) convierto a mayuscula el nombre del atributo q quiero ingresar
         if($(el).html()==capitalize(valor)){     
         va=1;    
         }
     });
    return va;
    }
function eliminarElementoDom($id_att) {
 $("input[type='button']").on('click',function(){
     dat=$(this).attr('ident');
        $("#my-dynamic-form input").each(function (idx, el){
     if($(el).attr('name')==dat){
         va=$(el).attr('name');
         $("#my-dynamic-form input").remove("#"+va+"");
        $("#my-dynamic-form div").remove("#"+va+""); 
        $("#my-dynamic-form input").remove("#"+$id_att+"");
     };
     });
// 
    }
            
     )};
  function validarFormulario(){
     var con=0;
     var ok=false;
        $("#my-dynamic-form input").each(function (idx, el){
   con++;
     });
    if(con>2){
        ok=true;
    }else{
        alert('Debe agregar al menos un atributo al formulario.\n Si no sabe como hacerlo, lea el manual en Ingreso');
        ok=false;
    }
     return ok;
 }
//function ver_data_estado() 
//{ 
//alert("boton presionado | ID: "+$(this).attr('ident')); 
//} 
function capitalize(s)//convierte minusculas a Mayusculas
{
    return s.toUpperCase();
}
     
        
        </script>     
<body>
   <?php include 'cabezal.php';?>
    <div class="container-fluid">
          <div id="menus">
                <a href="#" onclick="mostrarDiv()"> <button id="mostrar"  class="btn btn-primary btn-group-sm">Agregar Campo</button></a>
   <a href="#" onclick="mostrarDiv()"> <button id="ocultar"  class="btn btn-primary btn-group-sm">Ocultar Tabla de Atributos</button></a>
       <form id="miform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <br> <table class="table-responsive" border="1">  
               <tr> 
               <td>Nombre y tipo Campo :</td>    
              </tr>   
           <?php    
         require_once ('./clases/atributo.php');
         $atr=new atributo();
         $resultado=$atr->traerAtributos();
          if(isset($resultado)){
          foreach ($resultado as $key => $value) {?>
             <tr class="agregar">  
                <td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="<?php echo $value->getNombre()?>" hidden=""><?php echo $value->getNombre();?>    
              &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="<?php echo $value->getTipo(); ?>" hidden=""><?php echo $value->getTipo(); ?></a>         
           <input type="text" name="id_att" class="id_att" value="<?php echo $value->getId_attributo(); ?>" hidden="">   
           </td>                   
           </tr>  
<?php }}?>
          </table>  
      </form>
          
                <div style="position: absolute;float: right;">    
    <form id="formversion" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <br> <table class="table-responsive" border="1">  
                <tr>
                  <td>Formularios :</td>
               </tr>
               <?php
               require_once ('./clases/atributo.php');
    require_once ('./clases/formulario.php');
    require_once ('./clases/form_attr.php');
    require_once ('./clases/estudio_medico.php');
               $form=new formulario();
          $resultados=$form->traerFormularios();
          if($resultados!=null){
          foreach ($resultados as $key => $formulario) {?>
       <tr class="version1">
    <td class="formu">
     <a style="cursor:pointer;">   <input type="text" id="formular" name="formular" class="formular" value=" <?php echo $formulario->getNombre(); ?>" hidden="">
        <?php echo strtoupper($formulario->getNombre()); ?></a></td>                 
                   </tr>
          <?php   
          }} ?>

           </table> 
           </form>    
                </div> 
           
          </div>
      <h6><font style="color: red;">Para eliminar atributo agregado,<br> doble click sobre el boton |-| al costado de cada atributo</font> </h6>
      
     <?php
error_reporting(0);
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
      <div style="float: right;"><h6><font style="color: red;">Para agregar atributo,<br> click sobre el nombre del atributo</font> </h6></div>
       <div id="avizo"></div>
      
      <h3>Formulario</h3>
      <form id="my-dynamic-form" method="POST" action="nuevaVersion.php" onsubmit="return validarFormulario()"> 
      </form>
       </div> 
</body>
</html>