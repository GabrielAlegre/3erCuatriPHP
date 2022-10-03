<?php
include_once "./ejercicio29LoginConBD/Usuario.php";

$claveRecibidoPorPost=$_POST['clave'];
$mailRecibidoPorPost=$_POST['mail'];

$usuario=new Usuario($claveRecibidoPorPost, $mailRecibidoPorPost);

echo $usuario->verificarUsuarioSiExiste();

?>