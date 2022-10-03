<?php

include_once "./Garage.php";

$garage=new Garage("mvp", 35);

$autoUno=new Auto("Volkswagen", "Azul", 354);
$autoDos=new Auto("Toyota", "Amarillo", 123, date("j/n/y"));
$autoTres=new Auto("Fiat", "Rojo");
$autoRepetidoAlTres=new Auto("Fiat", "Rojo");


//Agrego tres autos, deberia agregarlos sin problemas e informalo
$garage->add($autoUno);
$garage->add($autoTres);
$garage->add($autoDos);

//Agrego un auto repetido, deberia no agregarlo e informal el porque
$garage->add($autoRepetidoAlTres);


$Auto1 = new Auto("Toyota", "Amarillo", 2435, date("j/n/y"));
$Auto2 = new Auto("Fiat", "Rojo", 53536, date("j/n/y"));
$Auto3 = new Auto("Ferrari", "Verde", 76845, date("j/n/y"));
$Auto4 = new Auto("Ford", "Negro", 5477, date("j/n/y"));
$Auto5 = new Auto("Audi", "Gris", 74235, date("j/n/y"));
$Auto6 = new Auto("Honda", "Violeta", 321324, date("j/n/y"));
$Auto6 = new Auto("Nissan", "Azul", 125653, date("j/n/y"));
$Auto6 = new Auto("Bmw", "Blanco", 175723, date("j/n/y"));
$arrayDeAutos=array($Auto1, $Auto2, $Auto3, $Auto4, $Auto5, $Auto6);

$segundoGarage=new Garage("PepitoPistolero", 6464);
foreach($arrayDeAutos as $unAuto){
    $segundoGarage->Add($unAuto);
}

$arrayDeGarages = array($garage, $segundoGarage);

Garage::guardarGarage($arrayDeGarages);



//Muestro el garage para verificar que solo se hayan agregado los 3 autos correspondientes
$garage->mostrarGarage();


//Pruebo el equals con un auto repetido, deberia informar que el auto ya esta en el garage
if($garage->equals($autoRepetidoAlTres))
{
    echo "<br>El auto esta en el garage <br>";
}
else
{
    echo "<br>El auto NO esta en el garage<br>";
}

//pruebo el equals con un auto que no esta en el array, deberia informar que el auto no esta en el garage
$nuevoAuto=new Auto("Ferrari", "Verde", 356477, date("j/n/y"));
if($garage->equals($nuevoAuto))
{
    echo "<br>El auto esta en el garage<br><br>";
}
else
{
    echo "<br>El auto NO esta en el garage<br><br>";
}

//Elimino un auto que esta en el garage, deberia eliminarlo e informarlo
$garage->remove($autoDos);

//Muestro el garage para verificar que el auto se haya eliminado
$garage->mostrarGarage();

//Trato de elimino un auto que NO esta en el garage, deberia informar que no se elimino el auto xq no existe en el garage
$garage->remove($nuevoAuto);

echo "<br>-------------------------------PARTE ARCHIVOS:-----------------------------<br><br>";

Garage::guardarGarage($arrayDeGarages);

$arrayDeAutosLeidosEnElArchivo=Garage::leerGarages();

foreach ($arrayDeAutosLeidosEnElArchivo as $garage) {
    $garage->mostrarGarage();
}
?>