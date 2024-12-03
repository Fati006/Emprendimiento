<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
    
<style>
    body{
        background-color: rgb(96, 137, 119);
    }
    header{
        background-color: white;
        padding: 25px;
        border: solid white 10px;
        text-align: right;
    }
    header  a{
        text-decoration: none;
        color: black;
        font-size: larger;
    }
    section{
        background-color: rgb(223, 242, 234);
    }
    footer{
        background-color: white;
}
</style>

</body>
</html>


<?php
session_start();

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<h2>Tu carrito de compras</h2>";
    echo "<table>";
    echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Acciones</th></tr>";

    $total = 0;
    foreach ($_SESSION['carrito'] as $indice => $producto) {
        $subtotal = $producto['precio'] * $producto['cantidad'];
        $total += $subtotal;

        echo "<tr>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>" . $producto['cantidad'] . "</td>";
        echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
        echo "<td>$" . number_format($subtotal, 2) . "</td>";
        echo "<td><a href='eliminar.php?id=" . $producto['id'] . "'>Eliminar</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p>Total: $" . number_format($total, 2) . "</p>";
    echo "<a href='checkout.php'>Proceder a la compra</a>";
} else {
    echo "<p>Tu carrito está vacío.</p>";
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el producto del carrito
    foreach ($_SESSION['carrito'] as $indice => $producto) {
        if ($producto['id'] == $id) {
            unset($_SESSION['carrito'][$indice]);
            break;
        }
    }

    // Redirige de vuelta al carrito
    header('Location: carrito.php');
    exit();
}

?>