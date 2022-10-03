<?php
include_once "./productoCopy.php";

$CodigoBarraRecibidoPorPost=$_POST['codigoDeBarra'];
$nombreRecibidoPorPost=$_POST['nombre'];
$tipoRecibidoPorPost=$_POST['tipo'];
$stockRecibidoPorPost=$_POST['stock'];
$precioRecibidoPorPost=$_POST['precio'];

$produc=new Producto($CodigoBarraRecibidoPorPost, $nombreRecibidoPorPost, $tipoRecibidoPorPost, $stockRecibidoPorPost, $precioRecibidoPorPost);

echo $produc->altaProducto();


?>