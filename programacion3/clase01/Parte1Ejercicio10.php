<?php

//Gabriel Alegre - Ejercicio 10

/*
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/

//ARRAY INDEXADO QUE CONTIENE COMO ELEMENTOS A TRES ARRAY
$arrayLapicerasIndexadas[0] = array(
    "color"=>"rojo",
    "marca"=>"bic",
    "trazo"=>0.8,
    "precio"=>120
);

$arrayLapicerasIndexadas[1] = array(
    "color"=>"negro",
    "marca"=>"pelikan",
    "trazo"=>1.2,
    "precio"=>200
);

$arrayLapicerasIndexadas[2] = array(
    "color"=>"azul",
    "marca"=>"faber castell",
    "trazo"=>0.5,
    "precio"=>180
);

echo "Array indexado: <br>";
for($i=0; $i<count($arrayLapicerasIndexadas); $i++)
{
    printf("<br>Datos de la %d lapicera<br>", $i+1);
    foreach($arrayLapicerasIndexadas[$i] as $clave => $valor)
    {
        echo "$clave: $valor <br>";
    }
}

//ARRAY ASOCIATIVO QUE CONTIENE COMO ELEMENTOS A TRES ARRAY
$arrayLapicerasAsociativas["primerLapicera"]=array(
    "color"=>"rojo",
    "marca"=>"bic",
    "trazo"=>0.8,
    "precio"=>120
);
 
$arrayLapicerasAsociativas["segundaLapicera"]=array(
    "color"=>"negro",
    "marca"=>"pelikan",
    "trazo"=>1.2,
    "precio"=>200
); 

$arrayLapicerasAsociativas["terceraLapicera"]=array(
    "color"=>"azul",
    "marca"=>"faber castell",
    "trazo"=>0.5,
    "precio"=>180
);

echo "<br>Array asociativo: <br>";
foreach($arrayLapicerasAsociativas as $key => $unaLapicera)
{
    echo "<br>Datos de la $key:<br>";
    foreach($unaLapicera as $campo => $valor)
    {
        echo "$campo:  $valor<br/>";
    }
}
?>