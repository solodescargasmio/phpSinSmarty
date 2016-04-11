<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

         <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <link href="css/dashboard.css" rel="stylesheet">
 <script>
 $('.campo1').click( function(){
        alert("click");});
 </script>
        <?php
  error_reporting(0);            
 require_once './clases/atributo.php';
               require_once ('./clases/formulario.php');     
                 $con=0;
            $atr=new atributo();
            $form=new formulario();
            $con=$atr->contarAtributos();
            $totalpag=0;
           $fin=5; 
           if($_POST['inicio']){
             $inicio=$_POST['inicio'];
           $actual=$_POST['actual'];   
           }else if($_GET['inicio']){
             $inicio=$_GET['inicio'];
           $actual=$_GET['actual'];   
           }else{
                $inicio=0;
           $actual=1;
           }
        
          
           $ca=0; 
            foreach ($con as $value) {
             $ca=$value; 
            }
               
            
            
             $totalpag=  ceil($ca/5); ?>
 
             <p>Pagina :<?php echo $actual.'/'.$totalpag ?></p> 
            <table class="table-responsive" border="1">   
               <tr> 
               <td>Nombre y tipo Campo :</td>    
             </tr> 
      <?php     $resultado=$atr->traerAtributosPaginados($inicio,$fin);
          if(isset($resultado)){
          foreach ($resultado as $key => $value) { ?>
             <tr class="agregar">  
               <td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="'.$value->getNombre().'" hidden="">'.$value->getNombre();    
                 &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="'.$value->getTipo().'" hidden="">'.$value->getTipo().'</a>         
                <input type="text" name="id_att" class="id_att" value="'.$value->getId_attributo().'" hidden=""> ';    
                 </td>;                    
                  </tr>  
 <?php  }} ?>
          </table> 
                 
                <?php  if($actual<$totalpag && $actual==1){ ?>
 <a href="paginador.php?inicio='.($inicio+5).'&actual='.($actual+1).'" id="siguiente">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>
              <?php    }else if($actual<$totalpag && $actual>1){ ?>
                   <a href="paginador.php?inicio='.($inicio-5).'&actual='.($actual-1).'" id="anterior"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a> ||    
            <a href="paginador.php?inicio='.($inicio+5).'&actual='.($actual+1).'" id="siguiente">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>
               <?php   }else 
                 if($actual==$totalpag && $actual>1){ ?>
                <a href="paginador.php?inicio='.($inicio-5).'&actual='.($actual-1).'" id="anterior"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a>  
               <?php   }else{ ?>
                   <a href="#">Actual</a> ;
                <?php } ?>
