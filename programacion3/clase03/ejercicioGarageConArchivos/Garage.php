<?php
/*
Aplicación No 18 (Auto - Garage) - Gabriel Alegre
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.
*/
include_once "../ejercicioAutoConArchivos/Auto.php";

class Garage
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    public function __construct($razonSocial, $precioHora=0)
    {
        $this->_razonSocial=$razonSocial;
        $this->_precioPorHora=$precioHora;
        $this->_autos=array();
    }

    public function mostrarGarage()
    {
        echo "<br>Datos del Garage:<br>";
        echo "Razon social: ".$this->_razonSocial."<br>";
        echo "Precio por Hora: ".$this->_precioPorHora."<br>";
        echo "Autos en el garage: <br>";
        foreach ($this->_autos as $unAuto) {
            echo Auto::mostrarAuto($unAuto);
        }
    }

    public function equals($autoQueVaSerBuscadoEnElGarege)
    {
        $estaElAuto=false;
        foreach ($this->_autos as $unAutoDelGarage) {
            if($unAutoDelGarage->equals($autoQueVaSerBuscadoEnElGarege)){
                $estaElAuto=true;
                break;
            }
        }
        return $estaElAuto;
    }


    public function add($autoParaAgregarAlGarage)
    {
        $mensajeInformativo="No se agrego el auto porque ya estaba en el garage<br>";

        if($this->equals($autoParaAgregarAlGarage)==false)
        {
            array_push($this->_autos, $autoParaAgregarAlGarage);
            $mensajeInformativo = "Se agrego el auto correctamente <br>";
        }

        echo $mensajeInformativo;
    }

    
    public function remove($autoParaEliminarDelGarage)
    {
        $mensajeInformativo="No se elimino el auto porque no esta en el garage<br>";

        if($this->equals($autoParaEliminarDelGarage))
        {
            unset($this->_autos[array_search($autoParaEliminarDelGarage, $this->_autos)]);   
            $mensajeInformativo= "Se elimino el auto correctamente <br>";
        } 

        echo $mensajeInformativo;
    }

    public static function garageFormatoCsv($unGarage)
    {
        $arrayAutos=[];
        foreach ($unGarage->_autos as $unAutoDelArray) {
            array_push($arrayAutos, Auto::autoFormatoCsv($unAutoDelArray));
        }

        return $unGarage->_razonSocial.','.$unGarage->_precioPorHora .'_'. implode('_', $arrayAutos);
    }

    public static function guardarGarage($arrayGarage)
    {
        if($arrayGarage!=NULL)
        {
            $archivo=fopen("garage.csv", "w");
            foreach ($arrayGarage as $unGarageDelArray) 
            {
                fwrite($archivo, Garage::garageFormatoCsv($unGarageDelArray).PHP_EOL);
            }
            fclose($archivo);
        }
    }

    
    public static function leerGarages()
    {
        $arrayGarages=[];
        $archivo = fopen("garage.csv", "r");
        $archivoParaRecuperarAutosDelGarage = fopen("garage.csv", "r");
       
        while(!feof($archivo))
        {
            //en la primera vuelta del while agarra la primera linea del archivo que seria el primer garage guardado, en la segunda vuelta agarra la segunda linea que seria el segundo auto guardado
            //Luego recupero cada dato y agrego los autos
            $datosDelGarage= fgetcsv($archivo);
            
            if($datosDelGarage)
            {
                $razonSocial=$datosDelGarage[0];
                $precioPorHora=(float)$datosDelGarage[1];
                $garage=new Garage($razonSocial, $precioPorHora);
                //Agrego al Garage todos los autos que contieneen el array del atributo _auto del garage
                Garage::agregarAutosAlGarage($archivoParaRecuperarAutosDelGarage, $garage);

                array_push($arrayGarages, $garage);
            }
        }
        fclose($archivo);

        return $arrayGarages;
    }

    public static function agregarAutosAlGarage($archivo, $garageDondeAgergarAuto)
    {
        //Para traer del archivo los autos que estarian en el garage, cada auto esta separado con un '_'
        $autosEnFormatoCsv= fgetcsv($archivo, 0, "_");

        var_dump($autosEnFormatoCsv);

        for ($i = 1; $i < count($autosEnFormatoCsv); $i++){

            $garageDondeAgergarAuto->add(Auto::crearAutoATravesDelCsv(explode(",", $autosEnFormatoCsv[$i])));
        }
    }
}
?>