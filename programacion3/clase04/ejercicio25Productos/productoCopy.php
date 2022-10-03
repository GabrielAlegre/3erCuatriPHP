<?php
/*Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior. */
class Producto
{
    private $_codigoDeBarra;
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;
    private $_id;

    public function __construct($codigoDeBarraDelProducto, $nombreDelProducto, $tipoProducto, $stockProducto, $precioProducto, $idProdu=0)
    {
        $this->_codigoDeBarra=$codigoDeBarraDelProducto;
        $this->_nombre=$nombreDelProducto;
        $this->_tipo=$tipoProducto;
        $this->_stock=$stockProducto;
        $this->_precio=$precioProducto;
        if($idProdu==0)
        {
            $this->_id=rand(1, 10000);
        }
        else
        {
            $this->_id=$idProdu;
        }
    }

    public static function productoFormatoCsv($unProducto)
    {
        $arrayDePropiedades=[];
        foreach ($unProducto as $propiedadesDelProducto) {
            array_push($arrayDePropiedades, $propiedadesDelProducto);
        }
        
        return implode(",", $arrayDePropiedades);
    }

    public function altaProducto()
    {
        $retornoInformativo="";
        if($this!=NULL)
        {
            $archivo=fopen("productos.csv", "a");
            if($this->verificarSiExisteProducto()!=1)
            {
                $sePudoGuardar=fwrite($archivo, Producto::productoFormatoCsv($this).PHP_EOL);

                if($sePudoGuardar==FALSE)
                {
                    $retornoInformativo="No se pudo hacer\n";
                }
                else
                {
                    $retornoInformativo="Producto INGRESADO correctamente\n";
                }
            }

            fclose($archivo);
        }

        return $retornoInformativo;
    }

    public static function leerProductos()
    {
        $arrayDeProductos=[];
        $archivo = fopen("productos.csv", "r");

        while(!feof($archivo))
        {
            $datosDelProducto= fgets($archivo);
            if($datosDelProducto!="")
            {
                $arrayDePropiedades=explode(",", $datosDelProducto);
                $codigoDeBarra=$arrayDePropiedades[0];
                $nombreDelProducto=$arrayDePropiedades[1];
                $tipoDelProducto=$arrayDePropiedades[2];
                $stockDelProducto=$arrayDePropiedades[3];
                $precioDelProducto=$arrayDePropiedades[4];
                $idDelProducto=trim($arrayDePropiedades[5]);
                
                array_push($arrayDeProductos, new Producto($codigoDeBarra, $nombreDelProducto, $tipoDelProducto, $stockDelProducto, $precioDelProducto, $idDelProducto));
            }
        }
   
        fclose($archivo);

        return $arrayDeProductos;
    }

    public function verificarSiExisteProducto()
    {
        $arrayDeProductosRegistrados=Producto::leerProductos();
        $ProductoExiste=0;

        for ($i=0; $i < count($arrayDeProductosRegistrados) ; $i++) { 
            if($this->_codigoDeBarra == trim($arrayDeProductosRegistrados[$i]->_codigoDeBarra))
            {
                Producto::actualizarProducto($arrayDeProductosRegistrados, $this, $i);
                return $ProductoExiste=1;
            }
        }

        return $ProductoExiste;
    }

    public static function actualizarProducto($arrayDeProductos, $productoRepetidoParaSumarStock, $indiceDondeEstaElRepetido)
    {

        if($arrayDeProductos!=NULL)
        {
            $arrayDeProductos[$indiceDondeEstaElRepetido]->_stock+=$productoRepetidoParaSumarStock->_stock;
            $archivo=fopen("productos.csv", "w");
            foreach ($arrayDeProductos as $unProductoDelArray) {
                fwrite($archivo, Producto::productoFormatoCsv($unProductoDelArray).PHP_EOL);
            }
            fclose($archivo);
        }
        echo "Producto ya existente. Se Actualizo el stock:\n";
        echo $arrayDeProductos[$indiceDondeEstaElRepetido]->mostrarProducto();
    }


    public function mostrarProducto()
    {
        return "\nDatos del producto:
        Id: {$this->_id}
        Codigo de Barra: {$this->_codigoDeBarra}
        Nombre del Producto: {$this->_nombre}
        Tipo: {$this->_tipo}
        Stock: {$this->_stock}
        Precio: {$this->_precio}\n";
    }   
}
?>