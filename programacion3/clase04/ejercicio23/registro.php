<?php
include_once "./usuario.php";

$claveRecibidoPorPost=$_POST['clave'];
$mailRecibidoPorPost=$_POST['mail'];
$nombreRecibidoPorPost=$_POST['nombre'];

$rutaAGuardarLaFoto = "./Usuario/Fotos/".$_FILES["imagenPorPost"]["name"];
move_uploaded_file($_FILES["imagenPorPost"]["tmp_name"], $rutaAGuardarLaFoto);

$usuario=new Usuario($nombreRecibidoPorPost, $claveRecibidoPorPost, $mailRecibidoPorPost);

echo $usuario->altaUsuario();
echo $usuario->mostrarUsuario();

?>