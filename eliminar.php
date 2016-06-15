<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Eliminar Datos</title>
     <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>
    <script type="text/javascript"> 
function confirmar(){ 
confirmado=confirm("¿Seguro que desea eliminarlo?"); 
if (confirmado) 
return true;
else 
return false;
} 
</script>
    </head>
    <body>
         <?php include 'cabezal.php';?>
        <div class="container-fluid" style="position: absolute;top: 30%;">
        <?php
       require_once ('./clases/session.php');
require_once ('./clases/tabla.php');
require_once ('./multimedia/guardarMultimedia.php');
require_once ('./multimedia/crearMKdir.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/datosPrecargados.php');
require_once ('./multimedia/crearMKdir.php');
require_once ('./multimedia/guardarMultimedia.php');
Session::init();
         $id_paciente=Session::get("cedula");
         $id_estudio=Session::get('estudio');
         $numero=Session::get('numero_estudio');
     $cedula=$id_paciente; 
     ?> 
            <p>Si elimina el Estudio Nº :<font style="color: red;"><?php echo $numero; ?></font> del paciente con cedula <font style="color: red;"><?php echo $cedula; ?></font>, toda la informacion <br>
        de este paciente, para este estudio, sera eliminada. 
        <a onclick="return confirmar();" href="elimino.php?id_est=<?php echo $id_estudio; ?>">Eliminar estudio</a>
        Si existen mas estudios para este paciente, el paciente NO sera eliminado completamente del sistema</p>
        <br>
        <p>Si elimina el paciente con cedula <font style="color: red;"><?php echo $cedula; ?></font>, toda la informacion <br>
        de este paciente sera eliminada.
        <a onclick="return confirmar();" href="elimino.php?id_pac=<?php echo $cedula; ?>">Eliminar paciente</a>
       El paciente sera eliminado en forma completa del sistema </p>
        <br>
        <p>Si presiona <font style="color: red;">Eliminar formulario</font>, los datos correspondientes a ese formulario, para este paciente, seran eliminados</p>
        <br>
            <?php
            if(isset($_GET['mensage'])){
                echo '<p>'.$_GET['mensage'].'</p>';
            }
                 $attr=new atributo();
                 $formula=new formulario();
                 $id_fop=$formula->traerId("paciente");
                 $resul=$formula->traerFormularios();
                 $estudio=new estudio_medico();
                 $estudio->setId_usuario($id_paciente);
                //  var_dump($id_paciente); var_dump($id_estudio);exit();
                 $ca=$estudio->contarEstudiosPaciente();
                  Session::init();
                 $cedu=Session::get('cedula');
                 
               
                 $num=Session::get('numero_estudio');;
                $estudios=$estudio->traerFormEchos($id_paciente);

                $tam=count($resul);
          echo '<table class="table table-condensed" border="1">'
                  . '<tr class="success">'
                  . '<td>Formulario :</td>'
                  . '</tr>';
                echo '<tr>';
       if($estudios!=null){
          foreach ($resul as $key => $value){
              
              echo '<tr>';
             if($estudio->okMas($id_paciente, $value->getId_form(),$num)){ 
                
                     echo '<td>'.strtoupper($value->getNombre()).'</td>';
                     if($value->getId_form()==$id_fop){
                                            echo '<td>No puede ser eliminado de forma individual. Elimine el estudio o al paciente</td>';        
 
                         
                     }else{
                     echo '<td><a onclick="return confirmar();" href="elimino.php?form='.$value->getNombre().'">'
                             . '<button class="btn btn-primary" >Eliminar '.strtoupper($value->getNombre()).'</button></a></td>';        
 }
             }
        echo '</tr>';
             }        
     }
     
   
          
         echo '</table>';             
                 if($cedu!=null){}else{
    echo '<br><br>';    }
       
        ?>
        </div>
        <?php include 'footer.php';?>
    </body>
</html>
