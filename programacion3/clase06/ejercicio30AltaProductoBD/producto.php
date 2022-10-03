<?php
/*Aplicación No 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase*/

include_once "./AccesoDatos.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');


class Producto
{
    private $_codigoDeBarra;
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;
    private $_fechaDeCreacion;
    private $_id;

    public function __construct($codigoDeBarraDelProducto, $nombreDelProducto, $tipoProducto, $stockProducto, $precioProducto, $idProdu=0, $fechaCreacion="")
    {
        $this->_codigoDeBarra=$codigoDeBarraDelProducto;
        $this->_nombre=$nombreDelProducto;
        $this->_tipo=$tipoProducto;
        $this->_stock=$stockProducto;
        $this->_precio=$precioProducto;
        $this->_fechaDeCreacion=date('Y/m/d H:i:s');
        $this->_id=$idProdu;
        if($fechaCreacion!="")
        {
            $this->fechaDeRegistro=$fechaCreacion;
        }
        else
        {
            $this->fechaDeRegistro=date('Y/m/d H:i:s');
        }
    }
    
    public function getStock()
    {
        return $this->_stock;
    }

    public function agregarProductoALaBaseDeDatos()
    {
        $productoBuscado = Producto::TraerProductoPorSuCodigoDeBarra($this->_codigoDeBarra);

        //Si el producto buscado es null es porque no existe en la base de datos entonces lo agrego
        if($productoBuscado == NULL)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RealizarConsulta(
            "INSERT INTO productos (CODIGO_DE_BARRA, NOMBRE, TIPO, STOCK, PRECIO, FECHA_DE_CREACION)
             VALUES('$this->_codigoDeBarra','$this->_nombre','$this->_tipo', '$this->_stock', '$this->_precio', '$this->_fechaDeCreacion')");   
            
            echo $consulta->execute() != FALSE ? "Ingresado. Se pudo agregar correctamente al siguiente producto a la base de datos:\n".$this->mostrarProducto($objetoAccesoDato) : "No se pudo hacer\n";
        }
        else //Si producto buscado es distinto de null es porque ya existia en la base de datos entonces le sumo stock
        {
            Producto::updateStockProducto($productoBuscado->_stock += $this->_stock, $productoBuscado->_codigoDeBarra);
            echo "Actualizado. El producto ya existia en la base de datos y se le actualizo el stock:\n".$productoBuscado->mostrarProducto();
        }
    }

    public static function TraerProductoPorSuCodigoDeBarra($codigoDeBarra) 
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RealizarConsulta("SELECT * FROM productos where CODIGO_DE_BARRA = $codigoDeBarra");
        $consulta->execute();
        $productoBuscado= $consulta->fetchObject();

        return $productoBuscado!=FALSE ? Producto::crearProducto($productoBuscado):NULL;				
    }

    public static function updateStockProducto($nuevoStock, $codigoDeBarraDelProducto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        
        $consulta =$objetoAccesoDato->RealizarConsulta("UPDATE productos SET productos.STOCK = $nuevoStock
                                                        WHERE productos.CODIGO_DE_BARRA='$codigoDeBarraDelProducto'");    
        return $consulta->execute();
    }
    
    public static function TraerTodoLosProductosDeLaBaseDeDatos()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RealizarConsulta("SELECT * FROM productos");
        $consulta->execute();
        $productos=[];			

        //cada indice del array va a tener un usuario recuperado de la base de datos
        $arrayDeProductosRecuperados= $consulta->fetchAll(PDO::FETCH_CLASS);
        
        //Recorro el array de productos que me va a devolver un objeto con las propiedades del usuario
        foreach ($arrayDeProductosRecuperados as $unProductoDeLaBaseDeDatos ) {
            //por cada vuelta del foreach creo un Producto con sus correspondientes propiedades
            array_push($productos, Producto::crearProducto($unProductoDeLaBaseDeDatos));
        }

        return $productos;
	}

    public static function crearProducto($unProductoDeLaBaseDeDatos)
    {
        return new Producto($unProductoDeLaBaseDeDatos->CODIGO_DE_BARRA,
        $unProductoDeLaBaseDeDatos->NOMBRE,
        $unProductoDeLaBaseDeDatos->TIPO,
        $unProductoDeLaBaseDeDatos->STOCK,
        $unProductoDeLaBaseDeDatos->PRECIO, 
        $unProductoDeLaBaseDeDatos->ID,
        $unProductoDeLaBaseDeDatos->FECHA_DE_CREACION);
    }


    public function mostrarProducto($objetoAccesoDato=NULL)
    {
        $id=$objetoAccesoDato != NULL ? $objetoAccesoDato->RetornarUltimoId() : $this->_id;
        return "Datos del producto:
        \nId: {$id}
        Codigo de Barra: {$this->_codigoDeBarra}
        Nombre del Producto: {$this->_nombre}
        Tipo: {$this->_tipo}
        Stock: {$this->_stock}
        Precio: {$this->_precio}
        Fecha de creacion: {$this->_fechaDeCreacion}\n";
    }  
    
    
}
?>