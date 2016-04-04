<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilosPaginador/meneame.css" type="text/css" rel="stylesheet"></link>
<title>BUSCADOR FULLTEXT + PAGINADOR</title>
</head>
<body>
    <?php
    // Parametros a ser usados por el Paginador.
    $cantidadRegistrosPorPagina	= 1; // Importantisimo que este en uno pues se mostrara un enlace
    $cantidadEnlaces            = 1; // Cantidad de enlaces que tendra el paginador.
    $totalRegistros             = 1653;
    $pagina                     = isset($_GET['pagina'])? $_GET['pagina'] : 0;
    
    // Comenzamos incluyendo el Paginador.
    require_once 'Paginador.php';
    
    // Instanciamos la clase Paginador
    $paginador          = new Paginador();

    // Configuramos cuanto registros por pagina que debe ser igual a el limit de la consulta mysql
    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
    // Cantidad de enlaces del paginador sin contar los no numericos.
    $paginador->setCantidadEnlaces($cantidadEnlaces);
    
    // Le marcamos cuales enlaces deseamos omitir.
    $paginador->setOmitir(array('primero',
                                'bloqueAnterior',
                                'bloqueSiguiente',
                                'ultimo',
                                'actual', // Este se puede omitir si queremos ver en que pag.estamos
                                'numero'));
    
    //Cambiamos los textos por defecto para anterior y siguiente
    $paginador->setTitulosVista('anterior', '<< anterior');
    $paginador->setTitulosVista('siguiente', 'siguiente >>');
    
    // Propagamos Variables
    $paginador->setPropagar(array('item','datos'));
    
    // Agregamos estilos al Paginador
    $paginador->setClass('actual', 'current');
    
    // Y mandamos a paginar desde la pagina actual y le pasamos tambien el total
    // de registros de la consulta mysql.
    $datos              = $paginador->paginar($pagina, $totalRegistros);
    
    // Preguntamos si retorno algo, si retorno paginamos. Nos retorna un arreglo
    // que se puede usar para paginar del modo clasico. Si queremos paginar con
    // el enlace ya confeccionado realizamos lo siguiente.
    if ($datos) {
        $enlaces = $paginador->getHtmlPaginacion('pagina', 'span');
    ?>
    <div class="meneame">
    <?php
        foreach ($enlaces as $enlace) {
            echo $enlace . "\n";
        }
    ?>
    </div><br/><br />
    <?php
    }
    ?>
</body>
</html>