<?php
//Gabriel Alegre - Ejercicio 05

/*Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.*/

$num = 45;
$decena;
$unidad = "";

if ($num >= 20 && $num <= 29) {
    $decena = "Veinte";
} else if ($num >= 30 && $num <= 39) {
    $decena = "Treinta";
} else if ($num >= 40 && $num <= 49) {
    $decena = "Cuarenta";
} else if ($num >= 50 && $num <= 59) {
    $decena = "Cincuenta";
} else {
    $decena = "Sesenta";
}

if ($num == 21 || $num == 31 || $num == 41 || $num == 51) {
    $unidad = "y Uno";
} else if ($num == 22 || $num == 32 || $num == 42 || $num == 52) {
    $unidad = "y Dos";
} else if ($num == 23 || $num == 33 || $num == 43 || $num == 53) {
    $unidad = "y Tres";
} else if ($num == 24 || $num == 34 || $num == 44 || $num == 54) {
    $unidad = "y Cuatro";
} else if ($num == 25 || $num == 35 || $num == 45 || $num == 55) {
    $unidad = "y Cinco";
} else if ($num == 26 || $num == 36 || $num == 46 || $num == 56) {
    $unidad = "y Seis";
} else if ($num == 27 || $num == 37 || $num == 47 || $num == 57) {
    $unidad = "y Siete";
} else if ($num == 28 || $num == 38 || $num == 48 || $num == 58) {
    $unidad = "y Ocho";
} else if ($num == 29 || $num == 39 || $num == 49 || $num == 59) {
    $unidad = "y Nueve";
}

print("$decena $unidad");

?>