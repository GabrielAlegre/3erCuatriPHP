<?php

include_once "Auto.php";

//● Crear dos objetos “Auto” de la misma marca y distinto color.
$primerAutoMismaMarcaDistintoColor=new Auto("Fiat", "Rojo");
$segundoAutoMismaMarcaDistintoColor=new Auto("Fiat", "Verde");

//● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
$tercerAutoMismaMarcaColorDistintoPrecio1=new Auto("Volkswagen", "Azul", 354);
$CuartoAutoMismaMarcaColorDistintoPrecio2=new Auto("Volkswagen", "Azul", 214);

//● Crear un objeto “Auto” utilizando la sobrecarga restante.
$quintoAutoCompleto=new Auto("Toyota", "Amarillo", 123, date("j/n/y"));;

//● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al atributo precio.
$tercerAutoMismaMarcaColorDistintoPrecio1->agregarImpuestos(1500);
$CuartoAutoMismaMarcaColorDistintoPrecio2->agregarImpuestos(1500);
$quintoAutoCompleto->agregarImpuestos(1500);

//● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado obtenido.
echo "<br>Importe obtenido por la suma del primer y segundo auto: ".Auto::add($primerAutoMismaMarcaDistintoColor, $segundoAutoMismaMarcaDistintoColor);

//● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
if($primerAutoMismaMarcaDistintoColor->equals($segundoAutoMismaMarcaDistintoColor))
{
    echo "<br><br>Primer y segundo auto SI son iguales";
}
else
{
    echo "<br>Primer y segundo auto NO son iguales";
}

if($primerAutoMismaMarcaDistintoColor->equals($quintoAutoCompleto))
{
    echo "<br>Primer y quinto auto SI son iguales";
}
else
{
    echo "<br>Primer y quinto auto NO son iguales";
}

//● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,5)
echo "<br><br>Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,5):";
Auto::mostrarAuto($primerAutoMismaMarcaDistintoColor);
Auto::mostrarAuto($tercerAutoMismaMarcaColorDistintoPrecio1);
Auto::mostrarAuto($quintoAutoCompleto);

//● Creo unos pares de autos y los guardo (linea 61), luego leo el archivo donde deben estar los autos guardados (linea 63)
echo "<br>-------------------------------PARTE ARCHIVOS:-----------------------------<br>";
$Auto1 = new Auto("Toyota", "Amarillo", 2435, date("j/n/y"));
$Auto2 = new Auto("Fiat", "Rojo", 53536, date("j/n/y"));
$Auto3 = new Auto("Ferrari", "Verde", 76845, date("j/n/y"));
$Auto4 = new Auto("Ford", "Negro", 5477, date("j/n/y"));
$Auto5 = new Auto("Audi", "Gris", 74235, date("j/n/y"));
$Auto6 = new Auto("Honda", "Violeta", 321324, date("j/n/y"));
$Auto6 = new Auto("Nissan", "Azul", 125653, date("j/n/y"));
$Auto6 = new Auto("Bmw", "Blanco", 175723, date("j/n/y"));
$arrayDeAutos=array($Auto1, $Auto2, $Auto3, $Auto4, $Auto5, $Auto6);

Auto::guardarAuto($arrayDeAutos);

$arrayDeAutosLeidosEnElArchivo=Auto::leerAutos();

foreach ($arrayDeAutosLeidosEnElArchivo as $auto) {
    echo Auto::mostrarAuto($auto);
}


?>