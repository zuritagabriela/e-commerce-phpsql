<?php
// Iniciamos la sesión, así tenemos acceso a las variables de sesión.

use App\Models\Productos;
use App\Auth\Autenticacion;
use Intervention\Image\ImageManagerStatic as Image;

session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';


if(!(new Autenticacion)->estaAutenticado()) {
    $_SESSION['mensajeError'] = "Se requiere haber iniciado sesión para ver este contenido.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
}


$id                 = $_GET['id'];
$nombre_producto    = $_POST['nombre_producto'];
$precio             = $_POST['precio'];
$imagen             = $_FILES['imagen'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$texto              = $_POST['texto'];


$bicicletas = (new Productos)->porId($id);

if(!$bicicletas) {
    // TODO: Mensaje de error.
    header('Location: ../index.php?s=productos');
    exit;
}


$errores = [];

if(empty($texto)) {
    $errores['texto'] = "Tenés que escribir la descripción del producto.";
} 
if(empty($nombre_producto)) {
    $errores['nombre_producto'] = "El nombre del producto no puede quedar vacio.";
} 



// Preguntamos si ocurrió algún error.
if(count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;

    header("Location: ../index.php?s=productos-editar&id=" . $id);
    exit;
}

if(!empty($imagen['tmp_name'])) {

    $nombreImagen = date('YmdHis') . "_" . $imagen['name'];

    Image::make($imagen['tmp_name'])
    ->fit(100, 100, function($constraint) {
        $constraint->upsize();
    })
    ->save(__DIR__ . '/../imagenes/' . $nombreImagen);

    Image::make($imagen['tmp_name'])
    ->fit(340, 300, function($constraint) {
        $constraint->upsize();
    })
    ->save(__DIR__ . '/../imagenes/big-' . $nombreImagen);

}



try {
    (new Productos)->editar($id, [
        'nombre_producto' => $nombre_producto,
        'precio' => $precio,
        'imagen' => $nombreImagen ?? $bicicletas->getImagen(),
        'imagen_descripcion' => $imagen_descripcion,
        'texto' => $texto,
    ]);

    $_SESSION['mensajeExito'] = "El producto <b>" . $nombre_producto . "</b> se editó con éxito.";
    header("Location: ../index.php?s=productos-admin");
    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrio un error inesperado.";
    header("Location: ../index.php?s=productos-editar&id=" . $id);
    exit;
}
