<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function calcularEdad($param) {
        
                 $fecha=date('d-m-Y');
                list($dia,$mes,$ano)=  explode('-', $fecha);
//fecha de nacimiento
        list($anoe,$mese,$diae)=  explode('-', $param);

//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

if (($mese == $mes) && ($diae > $dia)) {
$ano=($ano-1); }

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

if ($mese > $mes) {
$ano=($ano-1);}

//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

$edad=($ano-$anoe);

return $edad;
    }
    
    function calcularImc($peso,$altura) {
        $indice=$peso/($altura*$altura);
        $imc= number_format($indice,2,".",",");
return $imc;
    }
    
  
