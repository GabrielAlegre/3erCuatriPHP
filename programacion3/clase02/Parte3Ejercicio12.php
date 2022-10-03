<?php

//Gabriel Alegre - Ejercicio 12 

/*Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/

$unArray=array('H','O','L','A');
function invertirArray($array){

    $j=0;
    for($i=count($array)-1; $i>=0; $i--)
    {
        $arrayinvertido[$j]=$array[$i];
        $j++;
    }

    return $arrayinvertido;
}

$unArray=invertirArray($unArray);
foreach($unArray as $valor)
{
    echo $valor;
}
?>