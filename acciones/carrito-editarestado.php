<?php

use App\Models\Carrito;
use App\Auth\Autenticacion;

session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';


if(!(new Autenticacion)->estaAutenticado()) {
    $_SESSION['mensajeError'] = "Se requiere haber iniciado sesión para ver este contenido.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
}



$id                     = $_SESSION['idusuario'];
$estado                 = $_SESSION['estado'];


try {
    (new Carrito)->editarEstado($id, [
        'estado' => $estado,
    ]);
    header("Location: ../index.php?s=finalizar_compra&us=".$_SESSION['idusuario']);
    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrio un error inesperado.";
    header("Location: ../index.php?s=productos");
    exit;
}
