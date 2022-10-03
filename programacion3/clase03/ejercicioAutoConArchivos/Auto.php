<?php

/*Parte 4 - Ejercicios con POO Gabriel Alegre

Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos privados:

_color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
En testAuto.php:

● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)*/

class Auto
{
    private $marca;
    private $color;
    private $precio;
    private $fecha;

    public function __construct($marca, $color, $precio=0, $fecha="")
    {
        $this->marca=$marca;
        $this->color=$color;
        $this->precio=$precio;
        $this->fecha=$fecha;
    }

    public function agregarImpuestos($numeroDouble)
    {
       $this->precio+=$numeroDouble;
       echo "Se agrego impuestos correctamente <br>";
    }

    public static function mostrarAuto($unAutito)
    {
        echo "<br>Marca: ".$unAutito->marca."<br>";
        echo "Precio: ".$unAutito->precio."<br>";
        echo "Color: ".$unAutito->color."<br>";
        echo "Fecha: ".$unAutito->fecha."<br>";
    }

    public static function autoFormatoCsv($unAutito)
    {
        $arrayDePropiedades=[];
        foreach ($unAutito as $key) {
            array_push($arrayDePropiedades, $key);
        }
        
        return implode(",", $arrayDePropiedades);
    }


    public function equals($autito)
    {
        $sonIguales=FALSE;
        if($this->marca==$autito->marca)
        {
            $sonIguales=TRUE;
        }

        return $sonIguales;
    }


    public static function add($unAutito, $otroAutito)
    {
        $retorno="0 (estos dos autos no son iguales, tienen distinta marca y/o color)";
        if($unAutito->equals($otroAutito) && $unAutito->color===$otroAutito->color)
        {
            $retorno=$unAutito->precio+$otroAutito->precio;
        }
        return $retorno;
    }


    public static function guardarAuto($arrayDeAutos)
    {
        if($arrayDeAutos!=NULL)
        {
            $archivo=fopen("autos.csv", "w");
            foreach ($arrayDeAutos as $unAutoDelArray) {
                fwrite($archivo, Auto::autoFormatoCsv($unAutoDelArray).PHP_EOL);
            }
            fclose( $archivo);
        }
    }

    public static function leerAutos()
    {
        $arrayDeAutos=[];
        $archivo = fopen("autos.csv", "r");

        while(!feof($archivo))
        {
            $datosDelAuto= fgets($archivo);
            if($datosDelAuto!="")
            {
                array_push($arrayDeAutos, Auto::crearAutoATravesDelCsv(explode(",", $datosDelAuto)));
            }
        }
   
        fclose($archivo);

        return $arrayDeAutos;
    }

    public static function crearAutoATravesDelCsv($autoRecuperado)
    {
        $marcaAuto=$autoRecuperado[0];
        $colorAuto=$autoRecuperado[1];
        $precioAuto=(float)$autoRecuperado[2];
        $fechaAuto=$autoRecuperado[3];
        
        return new Auto($marcaAuto, $colorAuto, $precioAuto, $fechaAuto);

    }
}
?>