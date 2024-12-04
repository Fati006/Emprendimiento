<?php
session_start();


if (isset($_SESSION['carrito'])) {
    unset($_SESSION['carrito']);
   
    header('Location: pedidos_clientes.php');
    exit();
} else {
    header('Location: pedidos_clientes.php');
    exit();
}
?>
