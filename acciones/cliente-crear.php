<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

$nombre         = $_POST['nombre'];
$apellido       = $_POST['apellido'];
$provincia      = $_POST['provincia_fk'];
$codigo_postal  = $_POST['codigo_postal'];
$direccion      = $_POST['direccion'];
$localidad      = $_POST['localidad'];
$telefono       = $_POST['telefono'];
$rol_fk         = $_POST['rol_fk'];
$email          = $_POST['email'];
$password       = $_POST['password'];



try {
    (new \App\Models\Clientes())->crear([

        'nombre'        => $nombre,
        'apellido'      => $apellido,
        'provincia'     => $provincia,
        'partido'       => $partido,
        'localidad'     => $localidad,
        'codigo_postal' => $codigo_postal,
        'direccion'     => $direccion,
        'telefono'      => $telefono,
        'rol_fk'        => 2,
        'email' => $email,
        // Antes de mandar el password para grabarse, necesitamos hashearlo.
        'password' => password_hash($password, PASSWORD_DEFAULT),
        // Hardcodeamos el rol para que sea sí o sí un usuario común.
    ]);

    // TODO: Podríamos hacer que el usuario sea autenticado automáticamente.


    $_SESSION['mensajeExito'] = "Tu cuenta fue creada con éxito. Ya podés iniciar sesión.";
    header("Location: index.php?s=iniciar-sesion");
    exit;
} catch(\Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrió un error al crear la cuenta.";
    exit;
}
