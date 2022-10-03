<?php

//Gabriel Alegre - Ejercicio 09

/*
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
*/

$lapicera = array(
    "color"=>"rojo",
    "marca"=>"bic",
    "trazo"=>0.8,
    "precio"=>120
);

echo "Datos de la primera lapicera:<br>";
foreach($lapicera as $clave => $valor)
{
    echo "$clave: $valor <br>";
}

$lapicera = array(
    "color"=>"negro",
    "marca"=>"pelikan",
    "trazo"=>1.2,
    "precio"=>200
);
echo "<br>Datos de la segunda lapicera:<br>";
foreach($lapicera as $clave => $valor)
{
    echo "$clave: $valor <br>";
}

$lapicera = array(
    "color"=>"azul",
    "marca"=>"faber castell",
    "trazo"=>0.5,
    "precio"=>180
);
echo "<br>Datos de la tercera lapicera:<br>";
foreach($lapicera as $clave => $valor)
{
    echo "$clave: $valor <br>";
}
?>