<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudios Médicos||Formularios</title>
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
    $("#datepicker").datepicker(
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
   <?php include 'cabezal.php';?>
    <div class="container-fluid" style="position: absolute;top: 25%;">
        <div id="respuestauser"></div>
        <?php 
        error_reporting(0);
        require_once ('./clases/atributo.php');
require_once ('./clases/formulario.php');
require_once ('./clases/form_attr.php');

require_once ('./clases/session.php');
require_once ('./clases/tabla.php');
require_once ('./multimedia/guardarMultimedia.php');
require_once ('./multimedia/crearMKdir.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/datosPrecargados.php');
require_once ('./multimedia/crearMKdir.php');
require_once ('./multimedia/guardarMultimedia.php');
 $nick=  Session::get("nick");
     $operador=Session::get("usuario");
     $id_user=Session::get("cedula");
     $cedula=$id_user;  
      $id_paciente=$id_user;
    $apell=Session::get('apellido');
    $edad= Session::get('edad');
    $id_estudio= Session::get("estudio"); 
      $atr=new atributo();
        $tabla=new tabla();
        $form=new formulario();
      $nombre=trim($_GET['nombre']);
      $idf=trim($_GET['id_form']);
$ok=true;     
// aca controlo las dependencias:///////////////////
      $depen=new dependencia();
        $de=$depen->traerDepende($nombre);
        if($de){
           // $nomf=$form->traerNombre($de);
            $idfde=$form->traerId($de);
            $est=new estudio_medico();
            if($id_user){
            $da=$est->traerFormId_usuario($id_user, $idfde);
          
            if(isset($da)){
         $ok=true;
            }else{
       $mensage="El formulario: ".strtoupper($nombre)." : depende que el formulario : ".strtoupper($de)." esté COMPLETO";       
       $ok=false; 
            }}
        }//fin if $de
 //hasta aca controlo las dependencias:///////////////////       
         $fr_atr=new form_attr();
        $dat=$fr_atr->existenAtributos($idf);
        $atr=new atributo();
        $tabla=new tabla();

        if($id_estudio){
        $estu=new estudio_medico();
        $estudios=$estu->traerFormEstudioId($id_estudio, $idf);
//        foreach ($estudi as $key => $value) {
//           $estudios[]=$value;
//        }
        }
    if($dat>0){
        $resultado=$atr->traerAtributosForm($idf);
        $tablas=$tabla->traerTablas(); 
        if($resultado==null){
          $mensage="No existen atributos para este formulario.<br> Ingrese una nueva version del formulario.";  
        }
           //
        }
      
        
     if((is_null($cedula)) &&  (strcmp($nombre,"paciente")!=0)){ ?>
   <h4>
               <font style="color: red;font-weight: bold;">Debe ingresar un paciente nuevo en el formulario "PACIENTE", <br>
               seleccionar un paciente de la lista ó buscar ID de un paciente en la caja que dice 'cedula paciente'</font></h4>
       <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="window.location='principal.php'">Atras</button>
    </div>
 <?php }
 else if(!$ok){

     ?><br><br>
        <font style="color: red;font-weight: bold;"><?php echo $mensage; ?></font> 
        <br><br>   <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="window.location='principal.php'">Atras</button>
    </div>
 <?php }
     else if(!isset($estudios)){
                
         ?>
        <form style="width: 500px;" role="form" method="POST" enctype="multipart/form-data" action="llenar.php">  
<fieldset><legend><?php if(isset($nombre)){ echo strtoupper($nombre);} ?></legend></fieldset>
            <input type="text" name="nomformulario" value="<?php echo $nombre; ?>" id="nomformulario" hidden="">
   <?php if(isset($resultado)){ 
     foreach ($resultado as $key => $atributo){
          ?>
                    <div class="form-group" style="border-width: 10px; background:#C8C0C0;">
    <label for="nombre" class="col-lg-2 control-label"><?php echo strtoupper($atributo->getNombre());?>:</label>
    <div class="col-lg-10">

        
        <?php
         if((strcmp($atributo->getTipo(),"double")==0)||(strcmp($atributo->getTipo(),"float")==0)){
             if($atributo->getObligatorio()==1){?>
             <input type="text" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>" required="">      
             <?php }else{?>
              <input type="text" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>">    
            <?php }
             }//fin (strcmp(atributo->getTipo(),"double")==0)||(strcmp(atributo->getTipo(),"float")==0
         else if(strcmp($atributo->getTipo(),"text")==0){
             if($atributo->getTabla()==1){
                 ?>
              <select name="<?php echo $atributo->getNombre();?>">
            <?php foreach ($tablas as $key => $opcion){
                    if($opcion->getId_atributo()==$atributo->getId_attributo()){?>
                  <option value="<?php echo $opcion->getOpcion();?>"><?php echo strtoupper($opcion->getOpcion());?></option>      
                    <?php }
                  } ?>
            </select>     
           <?php  }else if($atributo->getObligatorio()==1){?>
              <input type="text" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>" required="">  
           <?php }else {?>
              <input type="text" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>">  
           <?php }
         }else if(strcmp($atributo->getTipo(),"date")==0){
           
             if($atributo->getObligatorio()=="0"){ ?>
            <input type="text" class="form-control" name="<?php echo $atributo->getNombre();?>" id="datepicker" required="">     
                 <?php }else{ ?>
          <input type="text" class="form-control" name="<?php echo $atributo->getNombre();?>" id="datepicker">                
                     <?php }
         }else if(strcmp($atributo->getTipo(),"int")==0){
             if((strcmp($atributo->getNombre(),"id_paciente")==0)&&(strcmp($nombre,"paciente")!=0)){ ?>
        <input type="number" class="form-control" value="<?php echo $cedula;?>" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>" readonly="">         
           <?php  }else
               if($atributo->getObligatorio()==1){ ?>
        <input type="number" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>" required="">                  
                   <?php } else if(($atributo->getObligatorio()!=0)&&(strcmp($atributo->getNombre(),"id_paciente")!=0)&&(strcmp($nombre,"paciente")!=0)){ ?>
         <input type="number" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>">               
                   <?php }
                     else { ?>
         <input type="number" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>">               
     <?php }
        
                   
     }else if(strcmp($atributo->getTipo(),"file")==0){
         if($atributo->getObligatorio()==1){?>
         <input type="<?php echo $atributo->getTipo();?>" class="form-control" name="archivo[]" id="<?php echo $atributo->getNombre();?>" required="">           
             <?php }else{?>
         <input type="<?php echo $atributo->getTipo();?>" class="form-control" name="archivo[]" id="<?php echo $atributo->getNombre();?>">        
                 <?php }
     }else if($atributo->getObligatorio()==1){?>
         <input type="<?php echo $atributo->getTipo();?>" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>" required=""> 
         <?php }else{ ?>
       <input type="<?php echo $atributo->getTipo();?>" class="form-control" name="<?php echo $atributo->getNombre();?>" id="<?php echo $atributo->getNombre();?>">        
             <?php } 
             ?> 
        
        
        
        
    </div>
  </div>
     <?php } //fin foreach resultado as key => atributo
} //fin isset resultado
         ?>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Alta Datos</button>
    </div>
  </div>       
        </form>    
    
 <?php }else{ ?>            
 <form style="width: 500px;" role="form" method="POST" enctype="multipart/form-data">   
            <fieldset><legend><?php echo strtoupper($nombre); ?></legend></fieldset>
        <?php foreach ($estudios as $keys => $estudio) {
  ?>
            <input type="text" name="nomformulario" value="<?php echo $nombre; ?>" id="nomformulario" hidden="">
           <div class="form-group" style="border-width: 10px; background: #C8C0C0;">
               <label for="nombre" class="col-lg-2 control-label"><?php echo strtoupper($estudio->getNom_attributo()); ?></label>
    <div class="col-lg-offset-2 col-lg-10">
        <?php  if((strcmp($estudio->getNom_attributo(),"fecha_nacimiento")==0)||(strcmp($estudio->getNom_attributo(),"id_paciente")==0)||(strcmp($estudio->getNom_attributo(),"fecha_estudio")==0)||(strcmp($estudio->getNom_attributo(),"edad")==0)){ ?>
        <input type="text" class="form-control" value="<?php echo $estudio->getValor(); ?>" name="<?php echo $estudio->getNom_attributo(); ?>" readonly="">        
       <?php }else if((strcmp($estudio->getTipo(),"float")==0)||(strcmp($estudio->getTipo(),"double")==0)||(strcmp($estudio->getTipo(),"int")==0)){ ?>
       <input type="text" class="form-control" value="<?php echo $estudio->getValor(); ?>" name="<?php echo $estudio->getNom_attributo(); ?>" readonly="">      
           <?php }else { ?>
       <input type="<?php echo $estudio->getTipo(); ?>" class="form-control" value="<?php echo $estudio->getValor(); ?>" name="<?php echo $estudio->getNom_attributo(); ?>">        
               <?php } ?>
        </div>
  </div>
 <?php } ?> 
            <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
       <input type="submit" name="modificar" class="btn btn-primary btn-lg btn-block" value="Guardar Modificaciones">
       <br> <a href="principal.php" >   <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location:'ingresar.php'">Cancelar Modificacion</button> </a>
    </div>
  </div> 
        </form>
      
<?php } ?>
    </div>

</body>
 <link href="css/dateFechamio.css" rel="stylesheet">
 <script src="js/dateFechamio.js"></script>
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
$("#datepicker").datepicker(
        {
firstDay: 1,
onSelect: function (date) {
},
} );

});
</script>     
</html>