<?php
session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';

use App\Models\Carrito;

$usuario = (new \App\Auth\Autenticacion())->getIdusuario();


$producto=intval($_GET['id']);

$idorden                    = $usuario;
$usuario_fk                 = $usuario;
$producto_fk                = $producto;
$cantidad                   = $_POST['cantidad'];
$color                      = $_POST['color'];
$talle                      = $_POST['talle'];
$estado                     = 'Sin finalizar';


try {
    (new Carrito)->porIdproducto($producto_fk, $color, $talle);
    $_SESSION['mensajeExito'] = $cantidad;
    header("Location: ../acciones/carrito-editar.php");

} catch(Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de agregar al carrito. Por favor, vuelva a intentar más tarde.';
    header("Location: ../index.php?s=productos");
    exit;
}