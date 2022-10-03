<?php
/*Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior. */ 

include_once "./usuario.php";

$nombreRecibidoPorPost=$_POST['nombre'];
$claveRecibidoPorPost=$_POST['clave'];
$mailRecibidoPorPost=$_POST['mail'];

$usuario=new Usuario($nombreRecibidoPorPost, $claveRecibidoPorPost, $mailRecibidoPorPost);

if($usuario->altaUsuario())
{
    echo "Se dio de alta y se guardo correctamente al usuario";
}
else
{
    echo "NO se pudo dar de alta ni guardar al usuario";

}
?>