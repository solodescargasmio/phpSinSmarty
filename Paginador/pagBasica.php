<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilosPaginador/digg.css" type="text/css" rel="stylesheet"></link>
<title>ObjetivoPHP.com - Paginador 2.3.0</title>
</head>
<body>
  
    <?php
     error_reporting(0);
            require_once ('./clases/atributo.php');
            require_once ('./clases/formulario.php');
//            require_once ('./Paginador/Paginador.php');
//            $paginador=new Paginador();
            $con=0;
            $atr=new atributo();
            $form=new formulario();
            $ca=$form->traerCantidad("ficha_patronimica");
            $con=$atr->contarAtributos();
            $totalpag=0;
           $fin=5; 
           $inicio=0;
           $actual=1;
           if($_GET['inicio']){
               $inicio=$_GET['inicio'];
               $actual=1+ceil($inicio/5);
           }
            foreach ($con as $value) {
             $ca=$value;   
            }
            $totalpag=  ceil($ca/5);
//            $paginador->setCantidadRegistros($totalpag);
//                if(isset ($_POST['inicio'])){
//                    $inicio=$_POST['inicio'];
//                }
            //$paginador->
            $id='';
            $atributos=$atr->traerAtributosPaginados($inicio,$fin);
//            foreach ($atributos as $key => $value) {
//                echo '<tr class="agregar">';
//  echo'<td class=campo1><a style=cursor:pointer;><input type=text name=campo class=campo value='.$value->getNombre().' hidden=>'.$value->getNombre();
//  echo '&nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value='.$value->getTipo().' hidden="">'.$value->getTipo().'</a></td>';
//  echo '</tr>';
//  $id=$value->getId_attributo();
//}
//$inicio=$inicio+$fin;
              
echo '</table>'; 


//               if($actual<$totalpag || $actual==1){
//            echo '<a href=paginador.php?inicio='.$inicio.'&actual='.$actual.'><button id="sig">Siguiente >></button></a>';       
//               }  else  if($actual==$totalpag && $actual>1){
//                   $inicio=$inicio-10;$actual=$actual-1;
//            echo '<a href=paginador.php?inicio='.$inicio.'&actual='.$actual.'><button id="sig">Atras</button></a>';       
//               }
//               else  
//              if($actual<$totalpag && $actual>1 && $inicio>5){
//            echo '<a href=paginador.php?inicio='.$inicio.'&actual='.$actual.'><button id="sig">Siguiente >></button></a>';
//            echo '<a href=paginador.php?inicio='.($inicio-10).'&actual='.($actual-1).'><button id="sig"><< Atras</button></a>';  
//            }
  
    $cantidadRegistrosPorPagina	= 5;
    $cantidadEnlaces            = $totalpag;
    $totalRegistros             = $ca;
    $pagina                     = isset($_GET['inicio'])? $_GET['inicio'] : 0;
    
    require_once 'Paginador.php';
    $paginador  = new Paginador();

    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
     /** AQUI INCLUIREMOS NUESTRO CODIGO DE CONFIGURACION DE ESTILOS */
     //$paginador->setClass('numero',          '<>');
    //$paginador->setClass('actual',          'active');
    //$paginador->setClass('siguiente',       'next',         'next-off');
    //$paginador->setClass('bloqueAnterior',  'previous',     'previous-off');
    //$paginador->setClass('bloqueSiguiente', 'next',         'next-off');
    //$paginador->setClass('primero',         'previous',     'previous-off');
    //$paginador->setClass('ultimo',          'next',         'next-off');
    

    $paginador->setCantidadEnlaces(7);
    $paginador->setOmitir(array('primero',
                                'bloqueAnterior',
                                'ultimo',
                                'bloqueSiguiente'));
    $paginador->setMarcador(null, null);
    
    $paginador->setTitulosVista('anterior',  '<<Previous');
    $paginador->setTitulosVista('siguiente', 'next>>');
    
    $paginador->setClass('anterior',        'previous',     'previous-off');
    $paginador->setClass('siguiente',       'next',         'next-off');
    $paginador->setClass('actual',          'active');
    $paginador->setClass('numero',          '<>');
    
    $datos      = $paginador->paginar($pagina, $totalRegistros);
    $enlaces    = $paginador->getHtmlPaginacion('pagina', 'li');
    ?>
    <ul id="pagination-digg">
    <?php
        foreach ($enlaces as $enlace) {
            echo $enlace . "\n";
        }
    ?>
    </ul>
</body>
</html>