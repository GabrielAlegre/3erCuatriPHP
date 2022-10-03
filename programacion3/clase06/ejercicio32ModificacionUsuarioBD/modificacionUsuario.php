<?php
include_once "./ejercicio32ModificacionUsuarioBD/Usuario.php";

$claveRecibidoPorPost=$_POST['claveActual'];
$mailRecibidoPorPost=$_POST['mail'];
$nombreRecibidoPorPost=$_POST['nombre'];
$nuevaClavePorPost=$_POST['claveNueva'];

$usuario=new Usuario($claveRecibidoPorPost, $mailRecibidoPorPost, $nombreRecibidoPorPost);


echo $usuario->intentarCambiarClaveUsuario($nuevaClavePorPost);

?>