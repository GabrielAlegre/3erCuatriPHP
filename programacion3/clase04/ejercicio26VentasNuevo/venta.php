<?php
/*Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior. */
// include_once "./usuario.php";
include_once "../ejercicio25Productos/producto.php";
// include_once "./usuario.php";
include_once "../ejercicio23/usuario.php";
class Venta
{
    private $_codigoDeBarraDelProducto;
    private $_cantidadDeItemsQueElUserQuiereComprar;
    private $_IdDelUsuario;
    private $_IdDeLaVenta;

    public function __construct($codigoDeBarra, $cantidadAComprar, $idUser)
    {
        $this->_codigoDeBarraDelProducto=$codigoDeBarra;
        $this->_cantidadDeItemsQueElUserQuiereComprar=$cantidadAComprar;
        $this->_IdDelUsuario=$idUser;
        $this->_IdDeLaVenta=rand(1, 10000);

    }

    public static function ventaFormatoCsv($unaVenta)
    {
        $arrayDePropiedades=[];
        foreach ($unaVenta as $propiedadesDeLaVenta) {
            array_push($arrayDePropiedades, $propiedadesDeLaVenta);
        }
        
        return implode(",", $arrayDePropiedades);
    }

    public function altaDeLaVenta()
    {
        $retornoInformativo="";
        if($this!=NULL)
        {
            $archivo=fopen("ventas.csv", "a");
            if($this->verificarSiSePuedeRealizarLaVenta()==1)
            {
                $sePudoGuardar=fwrite($archivo, Venta::ventaFormatoCsv($this).PHP_EOL);

                if($sePudoGuardar==FALSE)
                {
                    $retornoInformativo="No se pudo hacer. Error al escribir el archivo\n";
                }
                else
                {
                    $retornoInformativo="Venta realizada exitosamente\n".$this->mostrarDatosDeLaVenta();
                }
            }

            fclose($archivo);
        }

        return $retornoInformativo;
    }

    public function verificarSiSePuedeRealizarLaVenta()
    {
        $arrayDeUsuariosRegistrados=Usuario::leerUsuarios();
        $arrayDeProductosRegistrados=Producto::leerProductos();

        $existeProductoYHayStock=0;
        $existeUsuario=0;
        $sePuedeRealizarLaVenta=0;
        $indiceDelProductoVendido=0;

        for ($i=0; $i <count($arrayDeProductosRegistrados); $i++) 
        { 
            if(trim($arrayDeProductosRegistrados[$i]->getCodigoDeBarra()) == $this->_codigoDeBarraDelProducto && $arrayDeProductosRegistrados[$i]->getStock() >= $this->_cantidadDeItemsQueElUserQuiereComprar)
            {
                $existeProductoYHayStock=1;
                $indiceDelProductoVendido=$i;
                break;
            }
        }

        foreach ($arrayDeUsuariosRegistrados as $unUsuarioRegistrado) {

            if(trim($unUsuarioRegistrado->getIdUsuario()) == trim($this->_IdDelUsuario))
            {
                $existeUsuario=1;
                break;
            }
        }

        if($existeProductoYHayStock == 1 && $existeUsuario == 1)
        {
            $sePuedeRealizarLaVenta=1;
            $stockActualizado=$arrayDeProductosRegistrados[$indiceDelProductoVendido]->getStock() - $this->_cantidadDeItemsQueElUserQuiereComprar;
            $arrayDeProductosRegistrados[$indiceDelProductoVendido]->setStock($stockActualizado);
            Producto::actualizarProducto($arrayDeProductosRegistrados);

        }
        else
        {
            echo $existeUsuario != 1 ? "\nNo se pudo hacer la venta porque no existe el usuario\n" : "";
            echo $existeProductoYHayStock != 1 ? "No se pudo hacer la venta por Falta de stock y/o porque no existe el producto\n" : "";
        }

        return $sePuedeRealizarLaVenta;

    }

    public function mostrarDatosDeLaVenta()
    {
        return "\nDatos de la Venta:
        \nId de la venta: {$this->_IdDeLaVenta}
        Codigo de Barra del producto vendido: {$this->_codigoDeBarraDelProducto}
        Cantidad de productos que el usuario compro: {$this->_cantidadDeItemsQueElUserQuiereComprar}
        Id del Usuario: {$this->_IdDelUsuario}\n";
    }   
}
?>