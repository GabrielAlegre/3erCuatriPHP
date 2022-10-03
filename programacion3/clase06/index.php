<?php

switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'POST':
        switch ($_POST['ejercicio']) {
            case '27Registro':
                include_once "./ejercicio27RegistroBD/Registro.php";
                break;

            case '29LoginBD':
                include_once "./ejercicio29LoginConBD/login.php";
                break;

            case '30AltaProductoBD':
                include_once "./ejercicio30AltaProductoBD/altaProducto.php";
                break;
            
            case '31RealizarVentaBD':
                include_once "./ejercicio31RealizarVentaBD/realizarVenta.php";
                break;

            case '32modificacionBD':
                include_once "./ejercicio32ModificacionUsuarioBD/modificacionUsuario.php";
                break;

            case '33ModificacionProductoBD':
                include_once "./ejercicio33ModificacionProductoBD/modificacionProducto.php";
                break;
                
                
        }
        break;

    case 'GET':
        switch ($_GET['ejercicio']) {
            case '28ListadoBD':
                include_once "./ejercicio28listadoBD/listado.php";
                break;
            default:
                break;
        }
        break;
        break;

    default:
        echo "REQUEST_METHOD invalido";
        break; 
}
?>