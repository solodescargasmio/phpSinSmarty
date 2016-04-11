<?php
echo '<br> <table class="table-responsive" border="1"> '; 
               echo '<tr> 
               <td>Nombre y tipo Campo :</td>    
              </tr>';

 require_once './clases/atributo.php';
 require_once ('./clases/formulario.php');
$RegistrosAMostrar=10;

//estos valores los recibo por GET
if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
//caso contrario los iniciamos
}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
	
}
 $conexion=conectar::realizarConexion();
$Resultado=$conexion->query("SELECT * FROM atributo LIMIT $RegistrosAEmpezar, $RegistrosAMostrar");

while($MostrarFila=$Resultado->fetch_object()){
	     echo '<tr class="agregar">';  
                echo '<td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="'.$MostrarFila->nombre.'" hidden="">'.$MostrarFila->nombre;    
                echo ' &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="'.$MostrarFila->tipo.'" hidden="">'.$MostrarFila->tipo.'</a>';         
                echo '<input type="text" name="id_att" class="id_att" value="'.$MostrarFila->id_attributo.'" hidden=""> ';    
                 echo '</td>';                    
                 echo ' </tr>';  
}

//******--------determinar las páginas---------******//
$atr=new atributo();
    $NroRegistros=$atr->contarAtributos();
    $PagAnt=$PagAct-1;
    $PagSig=$PagAct+1;
    $PagUlt=ceil($NroRegistros/10);

//verificamos residuo para ver si llevará decimales
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina

//desplazamiento
   echo "<a onclick=\"Pagina('1')\">Primero</a> ";
if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";



 