<?php

//Gabriel Alegre - Ejercicio 04

/*Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.*/

$operador = '/';
$op1=12;
$op2=0;

switch($operador)
{
    case '+':
        echo "$op1 + $op2 = ", $op1 + $op2;
        break;

    case '-':
        echo "$op1 - $op2 = ", $op1 - $op2;
        break;

    case '*':
        echo "$op1 * $op2 = ", $op1 * $op2;
        break;

    case '/':
        if($op2 != 0)
        {
            echo "$op1 / $op2 = ", $op1 / $op2;
        }
        else
        {
            echo "$op1 / $op2 = Math ERROR: No se puede dividir por 0";
        }
        break;

    default:
        echo "Operador invalido";
        break;
}
?>