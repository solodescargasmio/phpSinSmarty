<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Crear Formularios</title>
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
        alert("Ingrese un nombre al formulario. Gracias");
        }else {
			$('#miform').show(); //muestro mediante id 
                        $('#formversion').hide(); //oculto mediante id 
     
		} });
		$("#ocultar").on( "click", function() {
                         $('#miform').hide();
                          $('#formversion').show(); //muestro mediante id 
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
                <script>
          $(function() {
            var $fieldset = $('<fieldset>');    
    var $form = $("#my-dynamic-form");
    $('<div class="form-group" style="border-width: 10px; background:#C8C0C0;">'+
                 '<label  class="col-sm-8 control-label">Nombre Formulario(*)</label>'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="text" name="nom_formulario" id="nom_formulario" onblur="control();" onkeypress="return vacio(event);" required="">').appendTo($fieldset);
      $('</div></div>').appendTo($fieldset);
           $(' <div class="form-group">'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="submit" value="Guardar Formulario" ident="guardo" id="guardo" class="btn btn-primary btn-group-justified">').appendTo($fieldset);
      $('</div></div>').appendTo($fieldset); 
        $fieldset.appendTo($form);
       
        
  
    $('.campo1').click( function(){
            var $dato= $(".campo",this).val();
            var $dato1= $(".valor",this).val();
            var $id_att=0;
            $id_att=$(".id_att",this).val();
       da=recorrerDom($dato);
       if(da==0){ //si son distintos lo agrego
           gu="guardo";
           $("#my-dynamic-form input").remove("#"+gu+""); 
        $(' <div class="form-group" id="'+ $dato +'" style="border-width: 10px; background:#C8C0C0;">'+
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
$(function() {
    $('.version1').click( function(){
            var $datove= $(".formu",this).val();
        document.getElementById("nom_formulario").value=$datove;    
        });
    });
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
  $(function(){
    
  });
        
        </script>     
<body>
   <?php include 'cabezal.php';?>
    <div class="container-fluid">
          <div id="menus">
                <a href="#" onclick="mostrarDiv()"> <button id="mostrar"  class="btn btn-primary btn-group-sm">Agregar Campo</button></a>
   <a href="#" onclick="mostrarDiv()"> <button id="ocultar"  class="btn btn-primary btn-group-sm">Ocultar Tabla de Atributos</button></a>
   <a href="nuevaVersion.php" > <button id="ver"  class="btn btn-primary btn-group-sm">Nueva Version</button></a> 
  <!-- Buscar atributo <input type="search" name="buscaratr" id="buscaratr">-->  
   <form id="miform" class="form-horizontal"  method="post" enctype="multipart/form-data">
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
                    <input type="text" name="id_att" class="id_att" value="<?php echo $value->getId_attributo(); ?>" hidden>   
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
    <td class="formu"><?php echo strtoupper($formulario->getNombre()); ?></td>                 
                   </tr>
          <?php   
          }} ?>

           </table> 
           </form>    
                </div> 
           
          </div>
        <br><br>
         <div style="float: right;"><h6><font style="color: red;font-weight: bold;">Para agregar atributo,<br> click sobre el nombre del atributo</font> </h6></div>
      
      <h6><font style="color: red;font-weight: bold;">Para eliminar atributo agregado,<br> doble click sobre el boton |-| al costado de cada atributo</font> </h6>
      <?php
               error_reporting(0);
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
      <div id="avizo"></div>
      
      <h3>Formulario</h3>
      <form id="my-dynamic-form" method="POST" action="crearFormulario.php" onsubmit="return validarFormulario()"> 
      </form>
         
       </div> 
      <?php include 'footer.php';?>   
</body>
</html>