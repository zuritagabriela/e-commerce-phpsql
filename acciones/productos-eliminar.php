<?php

use App\Auth\Autenticacion;
use App\Models\Productos;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

if(!(new Autenticacion)->estaAutenticado()) {
    $_SESSION['mensajeError'] = "Se requiere haber iniciado sesión para ver este contenido.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
}

$id = $_GET['id'];

$producto = (new Productos)->porId($id);

if(!$producto) {
    // TODO: Mensaje de error.
    header('Location: ../index.php?s=productos');
    exit;
}

try {
    (new Productos)->eliminar($id);
    if($producto->getImagen() !== null) {
        unlink(__DIR__ . 'imagenes/' . $producto->getImagen());
    }
    $_SESSION['mensajeExito'] = "La noticia fue eliminada con éxito.";
    header("Location: ../index.php?s=productos");
    exit;
} catch(\Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrio un error inesperado.";
    header("Location: ../index.php?s=productos");
    exit;
}
