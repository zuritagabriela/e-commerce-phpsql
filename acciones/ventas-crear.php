<?php
use App\Models\Carrito;


session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$usuario_fk      = $_SESSION['idusuario'];
$idorden         = $_SESSION['idorden'];;
$id              = $_SESSION['idusuario'];
$estado          = $_SESSION['estado'];
$fecha           = date('Y-m-d');
try {

    (new \App\Models\Ventas())->crear([
        'usuario_fk'        => $usuario_fk,
        'estado'            => $estado,
        'idorden'           => $idorden,
        'fecha'             => $fecha,
    ]);
        try {
            (new Carrito)->editarEstado($id, [
                'estado' => $estado,
            ]);
        } catch(Exception $e) {
            // TODO: Agregar mensajes de feedback.
            $_SESSION['mensajeError'] = 'Ocurrió un error en actulizacion de la venta vuelva a intentarlo más tarde.';
            header("Location: ../index.php?s=productos");
            exit;
        }
       
    $_SESSION['mensajeExito'] = 'La venta se guardo con exito.';
    header("Location: ../index.php?s=productos");
    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrió un error vuelva a intentarlo más tarde .';
    header("Location: ../index.php?s=finalizar_compra");
    exit;
}



