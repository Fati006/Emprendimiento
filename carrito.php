<?php
session_start();

$direc= "localhost";
$user= "root";
$pass= "";
$db= "floraliza";

$conn= mysqli_connect($direc,$user,$pass,$db);

if (isset($_POST['agregar'])) {
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $insert= "INSERT INTO `pedidos` (`id_producto`,`nombre`,`precio`,`cantidad`,`id_usuario`) VALUES ('$id','$nombre','$precio','$cantidad')";
   
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    
    $existe = false;
    foreach ($_SESSION['carrito'] as $indice => $producto) {
        if ($producto['id'] == $id) {
            $_SESSION['carrito'][$indice]['cantidad'] += $cantidad;
            $existe = true;
            break;
        }
    }

    
    if (!$existe) {
        $_SESSION['carrito'][] = array(
            'id' => $id,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad
        );
    }

    
    header('Location: carrito.php');
    exit();
}
?>
