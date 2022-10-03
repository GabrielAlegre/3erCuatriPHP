<?php

//Gabriel Alegre - Ejercicio 01 

/*Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.*/

$suma=0;
$contador=1;

while($suma + $contador<1000){

    $suma+=$contador;
    print("Suma: $suma <br>");
    $contador++;
}

print("Cantidad de numeros sumados: $contador");

?>