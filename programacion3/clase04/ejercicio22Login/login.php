<?php
include_once "./usuario.php";

$claveRecibidoPorPost=$_POST['clave'];
$mailRecibidoPorPost=$_POST['mail'];
$nombreRecibidoPorPost=$_POST['nombre'];

$usuario=new Usuario($nombreRecibidoPorPost, $claveRecibidoPorPost, $mailRecibidoPorPost);

echo $usuario->verificarUsuarioSiExiste();

?>