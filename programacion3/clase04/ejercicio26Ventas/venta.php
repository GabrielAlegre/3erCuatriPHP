<?php
/*Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior. */
class Venta
{
    private $_codigoDeBarraDelProducto;
    private $_cantidadDeItemsQueElUserQuiereComprar;
    private $_IdDelUsuario;
    private $_IdDeLaVenta;
    private $_stockDisponibleDelProductoParaVender;

    public function __construct($codigoDeBarra, $cantidadAComprar, $idUser)
    {
        $this->_codigoDeBarraDelProducto=$codigoDeBarra;
        $this->_cantidadDeItemsQueElUserQuiereComprar=$cantidadAComprar;
        $this->_IdDelUsuario=$idUser;
        $this->_IdDeLaVenta=rand(1, 10000);
        $this->_stockDisponibleDelProductoParaVender=rand(10, 40);
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
                    $retornoInformativo="No se pudo hacer\n";
                }
                else
                {
                    $retornoInformativo="Venta realizada exitosamente\n";
                }
            }

            fclose($archivo);
        }

        return $retornoInformativo;
    }

    public function verificarSiSePuedeRealizarLaVenta()
    {
        $sePuedeRealizarLaVenta=0;

            if($this->_stockDisponibleDelProductoParaVender >= $this->_cantidadDeItemsQueElUserQuiereComprar && strlen($this->_codigoDeBarraDelProducto)==6 && $this->_IdDelUsuario>0)
            {
                $sePuedeRealizarLaVenta=1;
            }
        

        return $sePuedeRealizarLaVenta;
    }

    public function mostrarDatosDeLaVenta()
    {
        $stockDespuesDeLaVenta=$this->_stockDisponibleDelProductoParaVender-$this->_cantidadDeItemsQueElUserQuiereComprar;
        return "\nDatos de la Venta:
        \nId de la venta: {$this->_IdDeLaVenta}
        Codigo de Barra del producto vendido: {$this->_codigoDeBarraDelProducto}
        Cantidad de productos que el usuario compro: {$this->_cantidadDeItemsQueElUserQuiereComprar}
        Id del Usuario: {$this->_IdDelUsuario}
        Stock disponible ANTES de la venta: {$this->_stockDisponibleDelProductoParaVender}
        Stock disponible DESPUES de la venta: {$stockDespuesDeLaVenta}\n";
    }   
}
?>