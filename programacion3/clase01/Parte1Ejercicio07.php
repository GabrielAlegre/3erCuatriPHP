<?php

//Gabriel Alegre - Ejercicio 07

/*
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.
*/

$num=1;
$i=0;

do
{
    if($num % 2 != 0)
    {
        $miArray[$i]=$num;
        $i++;
    }
    $num++;

}while (count($miArray) != 10);

echo "Impresion del array con FOR:<br>";
for($i = 0; $i<count($miArray); $i++)
{
    echo "$miArray[$i] <br>";
}

echo "<br>Impresion del array con FOREACH:<br>";
foreach($miArray as $numeroDelArray)
{
    echo "$numeroDelArray <br>";
}

$i=0;
echo "<br>Impresion del array con WHILE:<br>";
while($i<count($miArray))
{
    echo "$miArray[$i] <br>";
    $i++;
}

?>