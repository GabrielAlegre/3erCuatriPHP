<?php
include_once "./ejercicio27RegistroBD/Usuario.php";

$nombreRecibidoPorPost=$_POST['nombre'];
$apellidoRecibidoPorPost=$_POST['apellido'];
$claveRecibidoPorPost=$_POST['clave'];
$mailRecibidoPorPost=$_POST['mail'];
$localidadRecibidoPorPost=$_POST['localidad'];

$usuario=new Usuario($nombreRecibidoPorPost, $apellidoRecibidoPorPost, $claveRecibidoPorPost, $mailRecibidoPorPost, $localidadRecibidoPorPost);

$usuario->agregarUsuarioALaBaseDeDatos();
?>