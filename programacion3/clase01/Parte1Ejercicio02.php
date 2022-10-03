<?php

//Gabriel Alegre - Ejercicio 02

/*Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.*/

$dia = date("j");
$mes = date("n");
echo "Fecha actual: " . date("$dia/$mes/y") . "<br>";
echo "Fecha actual: " . date("D M Y") . "<br>";
echo "Fecha actual: " . date("l F y") . "<br> <br>";


switch (date($mes)) {

    case 1:
    case 2:
    case 3:
        if ($dia > 20 && $mes == 3) {
            echo "Estamos en Otoño";
        } else {
            echo "Estamos en Verano";
        }
        break;

    case 4:
    case 5:
    case 6:
        if ($dia > 20 && $mes == 6) {
            echo "Estamos en Invierno";
        } else {
            echo "Estamos en Otoño";
        }
        break;

    case 7:
    case 8:
    case 9:
        if ($dia > 20 && $mes == 9) {
            echo "Estamos en Primavera";
        } else {
            echo "Estamos en Invierno";
        }
        break;

    case 10:
    case 11:
        echo "Estamos en Primavera";
        break;

    default:
        if ($dia > 20) {
            echo "Estamos en Verano";
        } else {
            echo "Estamos en Primavera";
        }
        break;
}
