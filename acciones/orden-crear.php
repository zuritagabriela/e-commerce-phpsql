<?php
session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';

$idorden                   = 2;
$estado                       = 'stock';

try {
    (new \App\Models\Ordenes())->crear([
        'idorden'        => $idorden,
        'estado'            => $estado,

    ]);
    $_SESSION['mensajeExito'] = 'Todo ok';
    header("Location: ../index.php?s=productos");
    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de agregar al carrito. Por favor, vuelva a intentar más tarde.';
    header("Location: ../index.php?s=finalizar_compra");
    exit;
}
