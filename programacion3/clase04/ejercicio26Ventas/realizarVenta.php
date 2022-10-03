<?php
include_once "./venta.php";

$CodigoBarraRecibidoPorPost=$_POST['codigoDeBarra'];
$idUsuarioRecibidoPorPost=$_POST['idUsuario'];
$cantItemsRecibidoPorPost=$_POST['cantidadDeItemsAComprar'];

$ventaRealizada=new Venta($CodigoBarraRecibidoPorPost, $cantItemsRecibidoPorPost, $idUsuarioRecibidoPorPost);

echo $ventaRealizada->altaDeLaVenta();
echo $ventaRealizada->mostrarDatosDeLaVenta();

?>