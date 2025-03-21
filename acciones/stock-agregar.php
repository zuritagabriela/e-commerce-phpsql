<?php
// Iniciamos la sesión, así tenemos acceso a las variables de sesión.

use App\Models\Stock;
use App\Auth\Autenticacion;

session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';


if(!(new Autenticacion)->estaAutenticado()) {
    $_SESSION['mensajeError'] = "Se requiere haber iniciado sesión para ver este contenido.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
}


$producto_fk  = $_POST['producto_fk'];
$cantidad     = $_POST['cantidad'];



try {

    (new Stock)->crear([
        'producto_fk'        => $producto_fk,
        'cantidad'            => $cantidad,

    ]);
  
    $_SESSION['mensajeExito'] = 'Todo ok';
    header("Location: ../index.php?s=productos");

    exit;
} catch(Exception $e) {



    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de agregar al carrito. Por favor, vuelva a intentar más tarde.';

    header("Location: ../index.php?s=productos-admin");
    exit;
}
