<?php
include_once "./ejercicio28ListadoBD/Usuario.php";


switch ($_GET['listado']) {
    case 'usuarios':
        $usuariosRecuperadosDeLaBaseDeDatos=Usuario::TraerTodoLosUsuariosDeLaBaseDeDatos();
        echo "\nUsuarios traidos de la base de datos: \n";
        foreach ($usuariosRecuperadosDeLaBaseDeDatos as $unUsuario) {
            echo $unUsuario->mostrarDatosDelUsuario();
        }

        break;
    
    default:
        echo "no disponible (por ahora)";
        break;
}
?>