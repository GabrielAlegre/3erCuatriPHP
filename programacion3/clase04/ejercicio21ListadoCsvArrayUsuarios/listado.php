<?php
/*Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista*/ 


include_once "./usuario.php";

if($_GET['listado']=="usuarios")
{
    $arrayDeUsuarios= Usuario::leerUsuarios();

    foreach ($arrayDeUsuarios as $unUsuarioDelArray) {
        echo $unUsuarioDelArray->mostrarUsuario();
    }
}

?>