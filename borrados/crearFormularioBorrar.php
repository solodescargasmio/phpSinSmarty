<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mostrar algo</title>
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
    </head>
        <style type="text/css">
        body { font-family:Lucida Sans, Arial, Helvetica, Sans-Serif; font-size:13px; margin:20px;}
        #main { width:960px; margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:300px; padding:5px; border:solid 1px #000;}
        .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}
        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}
        #steps li {font-size:24px; float:left; padding:10px; color:#b0b1b3;}
        #steps li span {font-size:11px; display:block;}
        #steps li.current { color:#000;}
        #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
        #makeWizard:hover { background-color:#000;}
    </style>
            <script>
$(document).ready(function(){
    $('#miform').hide(); 
		$("#mostrar").on( "click", function() {
			$('#miform').show(); //muestro mediante id
		 });
		$("#ocultar").on( "click", function() {

			$('#miform').hide(); //oculto mediante id
		});
	});
        </script>
                <script>
        $(function() {
            var $fieldset = $('<fieldset>');    
    var $form = $("#my-dynamic-form");
      $(' <div class="form-group">'+
                 '<label  class="col-sm-8 control-label">Nombre Formulario</label>'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="text" name="nom_formulario" required="">').appendTo($fieldset);
      $('</div></div>')
        $fieldset.appendTo($form);  
    $('.campo1').click( function(){

            var $dato= $(".campo",this).val();
            var $dato1= $(".valor",this).val();

       da=recorrerDom($dato);
       if(da==0){//si son distintos lo agrego
        $(' <div class="form-group" id="'+ $dato +'" title="Doble click para remover atributo">'+
                 '<label  class="col-sm-8 control-label">'+ capitalize($dato) +'</label>'+
    '<div class="col-lg-10">').appendTo($fieldset);
        $('<input type="text" id="'+ $dato +'" name="'+ $dato +'" value="'+ $dato1 +'" readonly=>').appendTo($fieldset);
        $('<input type="button" id="'+ $dato +'" value="-" style="color: red;" name="eliminar" ident="'+ $dato +'" onclick="eliminarElementoDom()"></div></div>').appendTo($fieldset);
        $fieldset.appendTo($form);}
    else{//si son iguales mando el alert e impido que un boludo ingrese dos veces el mismo atributo
        alert('El atributo que intenta agregar, ya existe en el formulario.');
    }
           
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

function eliminarElementoDom() {
 $("input[type='button']").on('click',function(){
     dat=$(this).attr('ident');  
        $("#my-dynamic-form input").each(function (idx, el){
     if($(el).attr('name')==dat){
         va=$(el).attr('name');
       $("#my-dynamic-form input").remove("#"+va+"");
        $("#my-dynamic-form div").remove("#"+va+"") 
     };

     });
// 
    }
     )};
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
  
  <div class="fondo">
      <h6><font style="color: red;">Para eliminar atributo agregado,<br> doble click sobre el boton |-| al costado de cada atributo</font> </h6>
      <h3>Formulario</h3>
      <form id="my-dynamic-form" action="atraparformulario.php" method="post" enctype="multipart/form-data">                            
           <div class="form-group">       
    <div class="col-lg-10">
   <input type="submit" value="Guardar Formulario" class="btn btn-primary btn-group-justified" id="boton">
   </div></div><br><br>      
      </form>
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
// var_dump($resultado);exit();
        foreach ($resultado as $valor) {
            ?>
              
               <tr class="agregar">
                   <td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="<?php echo $valor->getNombre(); ?>" hidden=""><?php echo $valor->getNombre(); ?>
                      &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="<?php echo $valor->getTpo(); ?>" hidden=""><?php echo $valor->getTpo(); ?></a></td>                 
                   </tr>
                             <?php  }         
    ?>
           </table> 

          
              
        </form>
       </div> 

</body>
</html>
