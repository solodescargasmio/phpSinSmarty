<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <link href="css/dashboard.css" rel="stylesheet">
 <script>
   $(function(){
      $("#siguiente").click(function(){
          alert('click');
          valor=parseInt(document.getElementById("inicio").value);
          valor= valor + 5;
          datatypo='borrar='+valor;
          $.ajax({
            url: "borrar.php",
            type: 'POST',
           data: datatypo,
            success: function (data) {
                    $("#resp").fadeIn(1000).html(data);    
                    }
          });
      });});
 </script>
        <?php
        error_reporting(0);
     require_once './clases/atributo.php';
               require_once ('./clases/formulario.php');             
               echo '<br> <table class="table-responsive" border="1">  ';   
               echo ' <tr>'; 
               echo '<td>Nombre y tipo Campo :</td>';    
              echo '</tr>';  
                 $con=0;
            $atr=new atributo();
            $form=new formulario();
            $con=$atr->contarAtributos();
            $totalpag=0;
           $fin=5; 
           
            if($_GET['borrar']){
                  $inicio=$_GET['borrar'];
               }else{
                   $inicio=0;
               }

           $actual=1;
           $ca=0; 
            foreach ($con as $value) {
             $ca=$value; 
            }
        
             $totalpag=  ceil($ca/5);
          $resultado=$atr->traerAtributosPaginados($inicio,$fin);
          if(isset($resultado)){
          foreach ($resultado as $key => $value) {?>
             <tr class="agregar">  
                <td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="<?php echo $value->getNombre()?>" hidden=""><?php echo $value->getNombre();?>    
              &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="<?php echo $value->getTipo(); ?>" hidden=""><?php echo $value->getTipo(); ?></a>         
           <input type="text" name="id_att" class="id_att" value="<?php echo $value->getId_attributo(); ?>" hidden="">   
           </td>                   
           </tr>  
<?php }}?>
           <div id="resp"></div>
<input type="text" id="inicio" value="<?php echo $inicio;?>" >
       <br> <p>Pagina : <?php echo $actual.'/'.$totalpag ?></p>
                <?php  if($actual<$totalpag && $actual==1){?>
  <a href="#" id="siguiente">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>
                <?php }else if($actual<$totalpaginas && $actual>1){?>
            <a href="#" id="anterior"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a> ||    
            <a href="#" id="siguiente">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>
                <?php }else 
                 if($actual==$totalpaginas && $actual>1){?>
              <a href="#" id="anterior"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a>   
                <?php }else{?>
                  <a href="#">Actual</a> 
                <?php } ?>
          </table> 


