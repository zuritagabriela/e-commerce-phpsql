<?php

use App\Auth\Autenticacion;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$email    = $_POST['email'];
$password = $_POST['password'];

try {
    if((new Autenticacion)->iniciarSesion($email, $password)) {

        if($_SESSION['idrol'] ===  2 ){

            if($_SESSION['idproducto'] === null){
                header("Location: ../index.php?s=productos");
            }else{
                header("Location: ../index.php?s=carrito&id=".$_SESSION['idproducto']);
            } 
        exit;
        }else{

        $_SESSION['mensajeExito'] = "¡Bienvenido al aréa del administrador!";
        header("Location: ../index.php?s=dashboard");
        exit;
        }
    }
    $_SESSION['oldData'] = $_POST;
    $_SESSION['mensajeError'] = "Las credenciales ingresadas no coinciden con ningún registro de nuestro sistema.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;

} catch(Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrió un error inesperado. Por favor, vuelva a intentarlo más tarde.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
}
