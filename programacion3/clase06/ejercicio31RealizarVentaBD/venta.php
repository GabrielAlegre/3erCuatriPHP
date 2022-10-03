<?php
/*Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases */

include_once "./AccesoDatos.php";
include_once "../clase06/ejercicio30AltaProductoBD/producto.php";
include_once "../clase06/ejercicio28ListadoBD/Usuario.php";
class Venta
{
    private $_codigoDeBarraDelProducto;
    private $_cantidadDeItemsQueElUserQuiereComprar;
    private $_IdDelUsuario;
    // private $_IdDeLaVenta;

    public function __construct($codigoDeBarra, $cantidadAComprar, $idUser)
    {
        $this->_codigoDeBarraDelProducto=$codigoDeBarra;
        $this->_cantidadDeItemsQueElUserQuiereComprar=$cantidadAComprar;
        $this->_IdDelUsuario=$idUser;
        // $this->_IdDeLaVenta=rand(1, 10000);
    }

    public function RealizarVentaYGuardarlaEnLaBaseDeDatos()
    {
        if($this->verificarSiSePuedeHacerLaVenta()!=FALSE)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RealizarConsulta(
            "INSERT INTO ventas (CODIGO_DE_BARRA_PROD, ID_USUARIO, CANTIDAD_COMPRADA)
             VALUES('$this->_codigoDeBarraDelProducto','$this->_IdDelUsuario','$this->_cantidadDeItemsQueElUserQuiereComprar')");
            
            echo $consulta->execute() != FALSE ? "Venta realizada correctamente\n".$this->mostrarDatosDeLaVenta($objetoAccesoDato) : "No se pudo hacer la venta\n";
        }
        else
        {
            echo "No se pudo hacer la venta";
        }
    }

    public function verificarSiSePuedeHacerLaVenta()
    {
        $sePuedeRealizarLaVenta=FALSE;
        $productoQueSeVaAVender=Producto::TraerProductoPorSuCodigoDeBarra($this->_codigoDeBarraDelProducto);
        $usuarioComprador=Venta::TraerUnUsuarioPorSuId($this->_IdDelUsuario);

        if($productoQueSeVaAVender != NULL &&  $usuarioComprador!= NULL && $productoQueSeVaAVender->getStock() >= $this->_cantidadDeItemsQueElUserQuiereComprar) 
        {
            if(Producto::updateStockProducto($productoQueSeVaAVender->getStock() - $this->_cantidadDeItemsQueElUserQuiereComprar, $this->_codigoDeBarraDelProducto))
            {
                $sePuedeRealizarLaVenta=TRUE;
            }
            else
            {
                $sePuedeRealizarLaVenta=FALSE;
            }
        }

        return $sePuedeRealizarLaVenta;
    }

    public static function TraerUnUsuarioPorSuId($idUser) 
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RealizarConsulta("SELECT * FROM usuarios where id = $idUser");
        $consulta->execute();
        $usuarioBuscado= $consulta->fetchObject();

        var_dump($usuarioBuscado);
        
        return $usuarioBuscado!=FALSE ? Usuario::crearUsuario($usuarioBuscado):NULL;				
	}

    public function mostrarDatosDeLaVenta()
    {
        return "\nDatos de la Venta:
        Codigo de Barra del producto vendido: {$this->_codigoDeBarraDelProducto}
        Cantidad de productos que el usuario compro: {$this->_cantidadDeItemsQueElUserQuiereComprar}
        Id del Usuario comprados: {$this->_IdDelUsuario}\n";
    }   
}
?>