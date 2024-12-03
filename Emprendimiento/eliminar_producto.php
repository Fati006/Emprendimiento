<?php
session_start();

// Verificar si se ha recibido un ID de producto
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Eliminar el producto del carrito
    foreach ($_SESSION['carrito'] as $key => $producto) {
        if ($producto['id_producto'] == $id_producto) {
            unset($_SESSION['carrito'][$key]);
            break;
        }
    }
    // Redirigir de nuevo al carrito
    header('Location: carrito.php');
    exit;
}
?>
