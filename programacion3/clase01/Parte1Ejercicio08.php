<?php

//Gabriel Alegre - Ejercicio 08

/*
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
*/

$v = array(1=>90, 30=>7, 'e'=>99, 'hola'=>'mundo');
//o
/*$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';*/

foreach($v as $clave => $valor)
{
    echo "$valor <br>";
}

?>