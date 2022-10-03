<?php
/*Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
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

    
    
    public function intentarModificarProducto()
    {
        $productoEncontrado = Producto::TraerProductoPorSuCodigoDeBarra($this->_codigoDeBarra);
        
        //Si el producto buscado es null es porque no existe en la base de datos entonces no se puede hacer la modificacion
        if($productoEncontrado == NULL)
        {
            return "No se pudo hacer. No existe ningun producto con el codigo de barra: {$this->_codigoDeBarra} que se recibio por POST\n";
        }
        else //Si producto buscado es distinto de null es porque ya existia en la base de datos entonces lo modifico con los datos recibidos por POST
        {
            Producto::updateProducto($this->_codigoDeBarra, "stock", $this->_stock += $productoEncontrado->_stock);
            Producto::updateProducto($this->_codigoDeBarra, "nombre", $this->_nombre);
            Producto::updateProducto($this->_codigoDeBarra, "tipo", $this->_tipo);
            Producto::updateProducto($this->_codigoDeBarra, "precio", $this->_precio);
            
            return "Actualizado. El producto ya existia en la base de datos y se le actualizaron sus campos:\n".$this->mostrarProducto().
            "\nEl producto antes de la modificacion era:\n".$productoEncontrado->mostrarProducto();
            
        }
    }

    public static function updateProducto($codigoDeBarraDelProducto, $queModificar, $nuevoValor)
    {
        $sePudoModificar=FALSE;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $queModificar=strtoupper($queModificar);

        if($queModificar == "PRECIO" || $queModificar == "STOCK" || $queModificar == "NOMBRE" || $queModificar == "TIPO")
        {
            $consulta =$objetoAccesoDato->RealizarConsulta("UPDATE productos SET productos.$queModificar = '$nuevoValor'
            WHERE productos.CODIGO_DE_BARRA='$codigoDeBarraDelProducto'");  
            $sePudoModificar = $consulta->execute();
        }
      
        return $sePudoModificar;
    }
    
    /*
    public static function updateProducto($codigoDeBarraDelProducto, $queModificar, $nuevoValor)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $queModificar=strtolower($queModificar);

        switch ($queModificar) {
            case "precio":
            $consulta =$objetoAccesoDato->RealizarConsulta("UPDATE productos SET productos.PRECIO = '$nuevoValor'
                                                            WHERE productos.CODIGO_DE_BARRA='$codigoDeBarraDelProducto'");    
                break;

            case "stock":
                $consulta =$objetoAccesoDato->RealizarConsulta("UPDATE productos SET productos.STOCK = '$nuevoValor'
                                                                WHERE productos.CODIGO_DE_BARRA='$codigoDeBarraDelProducto'");    
                break;

            case "nombre":
                $consulta =$objetoAccesoDato->RealizarConsulta("UPDATE productos SET productos.NOMBRE = '$nuevoValor'
                                                              WHERE productos.CODIGO_DE_BARRA='$codigoDeBarraDelProducto'");   
                break;

            case "tipo":
                $consulta =$objetoAccesoDato->RealizarConsulta("UPDATE productos SET productos.TIPO = '$nuevoValor'
                                                        WHERE productos.CODIGO_DE_BARRA='$codigoDeBarraDelProducto'");   
                break;
            
            default:
                return "No existe ese campo en producto";
                break;
        }
        
        return $consulta->execute();
    }*/
    
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
        \nCodigo de Barra: {$this->_codigoDeBarra}
        Nombre del Producto: {$this->_nombre}
        Tipo: {$this->_tipo}
        Stock: {$this->_stock}
        Precio: {$this->_precio}
        Fecha de creacion: {$this->_fechaDeCreacion}\n";
    }  
    
    
}
?>