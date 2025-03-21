<?php

use App\Auth\Autenticacion;
use App\Models\Productos;
use Intervention\Image\ImageManagerStatic as Image;



session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';


// if(!(new Autenticacion)->estaAutenticado()) {
//     $_SESSION['mensajeError'] = "Se requiere haber iniciado sesión para ver este contenido.";
//     header("Location: ../index.php?s=iniciar-sesion");
//     exit;
// }


$nombre_producto            = $_POST['nombre_producto'];
$precio                     = $_POST['precio'];
$texto                      = $_POST['texto'];
$imagen                     = $_FILES['imagen']; 
$imagen_descripcion         = $_POST['imagen_descripcion'];
$clase                      = $_POST['clase'];
$amortiguador               = $_POST['amortiguador'];
$rueda                      = $_POST['rueda'];
$cubiertas                  = $_POST['cubiertas'];
$sillin                     = $_POST['sillin'];
$bateria                    = $_POST['bateria'];
$categoria                  = $_POST['categoria'];


$errores = [];

if(empty($nombre_producto)) {
    $errores['nombre_producto'] = "Tenés que escribir el nombre del producto.";
} else if(strlen($nombre_producto) < 3) {
    $errores['nombre_producto'] = "El nombre de la noticia debe tener al menos 3 caracteres.";
}

if(empty($precio)) {
    $errores['precio'] = "El precio no puede estar vacio";
}

if(empty($imagen)) {
    $errores['imagen'] = "Tenés que subir una imagen.";
}

if(empty($imagen_descripcion)) {
    $errores['imagen_descripcion'] = "Tenés que escribir el Alt de la imagen.";
}

if(empty($texto)) {
    $errores['texto'] = "La descripcion del producto no puede estar vacio";
}



if(count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;

    header("Location: ../index.php?s=productos-crear");
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
    (new Productos)->crear([
        // 'idusuario_fk' => (new Autenticacion())->getIdusuario(),
        'nombre_producto' => $nombre_producto,
        'precio' => $precio,
        'texto' => $texto,
        'imagen' => $nombreImagen,
        'imagen_descripcion' => $imagen_descripcion,
        'clase' => $clase,
        'amortiguador' => $amortiguador,
        'rueda' => $rueda,
        'cubiertas' => $cubiertas,
        'sillin' => $sillin,
        'bateria' => $bateria,
        'categoria' => $categoria,
    ]);

    $mensajeExito = "El producto <b>" . $nombre_producto . "</b> se publicó con éxito.";
    $_SESSION['mensajeExito'] = "El producto <b>" . $nombre_producto . "</b> se publicó con éxito.";
    header("Location: ../index.php?s=productos-admin");

    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de publicar producto. Por favor, vuelva a intentar más tarde.';
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=productos-crear");
    exit;
}

