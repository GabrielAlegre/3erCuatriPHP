<?php
include_once "./venta.php";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $CodigoBarraRecibidoPorPost=$_POST['codigoDeBarra'];
    $idUsuarioRecibidoPorPost=$_POST['idUsuario'];
    $cantItemsRecibidoPorPost=$_POST['cantidadDeItemsAComprar'];
    
    $ventaRealizada=new Venta($CodigoBarraRecibidoPorPost, $cantItemsRecibidoPorPost, $idUsuarioRecibidoPorPost);
    
    
    echo $ventaRealizada->altaDeLaVenta();
}
else
{
    echo "Envie la petición por POST por favor";
}

?>