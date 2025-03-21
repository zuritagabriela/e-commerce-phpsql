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


$id                 = $_GET['id'];
$cantidad           = $_POST['stock'];

print_r($cantidad);

try {
    (new Stock)->editar($id, [
        'cantidad' => $cantidad,
    ]);

    // 6.

    $_SESSION['mensajeExito'] = "La cantidad se actualizo. .";
    header("Location: ../index.php?s=listado_carrito&id=".$_SESSION['idusuario']);
    exit;
} catch(Exception $e) {

    $_SESSION['mensajeError'] = "La cantidad se actualizo. .";
    // TODO: Agregar mensajes de feedback.
    header("Location: ../index.php?s=productos");
    exit;
}
