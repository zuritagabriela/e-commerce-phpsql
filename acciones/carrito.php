<?php
session_start();

require_once __DIR__ . '/../bootstrap/autoload.php';

use App\Models\Carrito;
use App\Models\Stock;
use App\Database\DB;

$usuario = (new \App\Auth\Autenticacion())->getIdusuario();

$fecha = getdate();


$arrayIdorden = [
'usuario'   => $usuario,
'minutos'   =>$fecha['minutes'],
'hora'      =>$fecha['hours'],
'dia'       =>$fecha['mday'],
'mes'       =>$fecha['mon'],
'anio'      =>$fecha['year']
];

$nroOrden=implode($arrayIdorden);


$idorden                    = $nroOrden;
$usuario_fk                 = $usuario;
$producto_fk                = intval($_GET['id']);
$cantidad                   = $_POST['cantidad'];
$color                      = $_POST['color'];
$talle                      = $_POST['talle'];
$estado                     = 'sin finalizar';

$errores = [];


    if(empty($talle)) {
        $errores['talle'] = "Debes seleccionar el talle";
    }

    if(empty($color)) {
        $errores['color'] = "Debes seleccionar el color";
    }

    if(count($errores) > 0) {
        // Ocurrieron errores, así que reenviamos al usuario al form.
        // Compartimos por medio de la sesión los mensajes de error.
        $_SESSION['errores'] = $errores;
        // Además, pasamos una variable más con los datos actuales del formulario, para que podamos re-poblar
        // ("re-populate") el formulario.
        $_SESSION['oldData'] = $_POST;

        header("Location: ../index.php?s=carrito&id=".$producto_fk);
        exit; // Acá sí es esencial el exit.
    }

    // $db = (new DB)->getConexion();
    // $query = "SELECT * FROM carrito
    //         WHERE producto_fk = $producto_fk AND color = '$color' AND talle = '$talle' ";
    // $stmt = $db->prepare($query); // $db lo obtenemos del archivo de conexión.
    // $stmt->execute();
    // $resultado = $stmt->fetch();

    // echo "<pre>";
    // print_r($resultado);
    // echo "</pre>";

    // if(!$resultado){
        
    // echo "entro";
    // }

    $aux = 1;

    if( !(new Carrito)->prodCoincide($producto_fk,$color,$talle) && ($_SESSION['estado']!='sin finalizar')){
                (new Carrito)->crear([
                            'idorden'        => $idorden,
                            'usuario_fk'     => $usuario_fk,
                            'producto_fk'    => $producto_fk,
                            'cantidad'       => $cantidad,
                            'color'          => $color,
                            'talle'          => $talle,
                            'estado'         => $estado,
                        ]);
                header("Location: ../index.php?s=productos");
    }else{
        (new Carrito)->editarCantidad($producto_fk, $color, $talle, $cantidad);
        (new \App\Models\Stock)->editar($producto_fk, $cantidad);
        $aux1=0;

        header("Location: ../acciones/eliminar_carrito.php?id=.$idcarrito");
        exit;
    }

