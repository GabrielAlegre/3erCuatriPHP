<?php

//Gabriel Alegre - Ejercicio 06

/*Aplicación No 6 Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.*/

$acumulador=0;
$promedio=0;

echo "Numeros que contiene el arrray: <br>";
for($i = 0; $i<5; $i++)
{
    $miArray[$i]=rand(1,25);
    $acumulador+=$miArray[$i];
    echo "$miArray[$i] <br>";
}

$promedio = $acumulador/5;

if($promedio>6)
{
    echo "<br>El promedio es mayor a 6 (El promedio es $promedio) <br>";
}
else if($promedio<6)
{
    echo "<br>El promedio es menor a 6 (El promedio es $promedio) <br>";
}
else
{
    echo "<br>El promedio es igual a 6 (El promedio es $promedio) <br>";
}

?>