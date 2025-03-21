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


$id =intval($_GET['id']);
$cantidad               = intval($_SESSION['cantidad']);


try {
    (new Carrito)->editar($id, $cantidad);
    $_SESSION['mensajeExito'] = "La cantidad se actualizo. .";
    header("Location: ../index.php?s=listado_carrito&us=".$_SESSION['idusuario']);
    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrio un error inesperado.";
    header("Location: ../index.php?s=productos");
    exit;
}
