 <?php 
               require_once './clases/atributo.php';
               require_once ('./clases/formulario.php');
               $dato=$_POST['borrar'];
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
           $inicio=$dato;
           $actual=1;
           $ca=0; 
            foreach ($con as $value) {
             $ca=$value; 
            }
               
             $totalpag=  ceil($ca/5);
          $resultado=$atr->traerAtributosPaginados($inicio,$fin);
          if(isset($resultado)){
          foreach ($resultado as $key => $value) {
              echo '<tr class="agregar">';  
                echo '<td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="'.$value->getNombre().'" hidden="">'.$value->getNombre();    
                echo ' &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="'.$value->getTipo().'" hidden="">'.$value->getTipo().'</a>';         
                echo '<input type="text" name="id_att" class="id_att" value="'.$value->getId_attributo().'" hidden=""> ';    
                 echo '</td>';                    
                 echo ' </tr>';  
}
          }
echo '<input type="text" id="inicio" value="'.$inicio.'" hidden>';
                  echo '<br> <p>Pagina : '.$actual.'/'.$totalpag.'</p> ';
                 if($actual<$totalpag && $actual==1){
  echo '<a href="#" id="siguiente">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>' ;
                 }else if($actual<$totalpaginas && $actual>1){
                     echo '<a href="#" id="anterior"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a> ||    
            <a href="#" id="siguiente">Siguiente<img src="./imagenes/flechaderecha.JPG" width="30" height="20"></a>';
                 }else 
                 if($actual==$totalpaginas && $actual>1){
                     echo '<a href="#" id="anterior"><img src="./imagenes/flechaizquierda.JPG" width="30" height="20">Anterior</a>';   
                 }else{
                     echo '<a href="#">Actual</a> ';
                 } 
          echo '</table> ';
          ?>
          

