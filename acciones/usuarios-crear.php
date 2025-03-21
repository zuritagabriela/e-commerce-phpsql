<?php
use App\Auth\Autenticacion;
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$nombre_usuario      = $_POST['nombre_usuario'];
$apellido            = $_POST['apellido'];
$email               = $_POST['email'];
$password            = $_POST['password'];


// TODO: Validar...

try {
    (new \App\Models\Usuarios())->crear([
        'nombre_usuario'    => $nombre_usuario,
        'apellido'          => $apellido,
        'email'             => $email,
        // Antes de mandar el password para grabarse, necesitamos hashearlo.
        'password'          => password_hash($password, PASSWORD_DEFAULT),

        // Hardcodeamos el rol para que sea sí o sí un usuario común.
        'idrol_fk'          => 2,
    ]);

    // TODO: Podríamos hacer que el usuario sea autenticado automáticamente.
    $_SESSION['mensajeExito'] = "Tu cuenta fue creada con éxito.";
    header("Location: ../index.php?s=index");

    try {

        if((new Autenticacion)->iniciarSesion($email, $password)) {
            if($_SESSION['idproducto'] === null){
                header("Location: ../index.php?s=productos");
            }else{
                header("Location: ../index.php?s=carrito&id=".$_SESSION['idproducto']);
            } 
        exit;
    }

    } catch(Exception $e) {
        $_SESSION['mensajeError'] = "Ocurrió un error inesperado. Por favor, vuelva a intentarlo más tarde.";
        header("Location: ../index.php?s=registrarse");
    exit;
    }

exit;
}catch(\Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrió un error al crear la cuenta.";
    header("Location: ../index.php?s=registrarse");
exit;
}
