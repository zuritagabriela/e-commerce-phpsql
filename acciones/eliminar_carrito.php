<?php


use App\Models\Carrito;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$id = intval($_GET['id']);


print_r($id);
$autenticacion = new \App\Auth\Autenticacion();

$idusuario = $_SESSION['idusuario'];

try {
    (new Carrito)->eliminar($id); 
    $_SESSION['mensajeExito'] = "Se elimino con exito";
    header("Location: ../index.php?s=listado_carrito&us=".$idusuario);
    exit;
} catch(\Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrio un error inesperado.";
    header("Location: ../index.php?s=productos");
    exit;
}
