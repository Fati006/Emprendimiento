<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style_carrito.css" rel="stylesheet">
    <title>Pedidos</title>
    <style>
        body {
            background-color: rgb(96, 137, 119);
        }
        header {
            background-color: white;
            padding: 25px;
            border: solid white 10px;
            text-align: right;
        }
        header a {
            text-decoration: none;
            color: black;
            font-size: larger;
        }
    
        footer {
            background-color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <a href="main.php">Inicio</a>
</header>

<section>
    <?php
    session_start();

    // Mostrar el carrito
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        echo "<h2 style= 'color: black'>Tu carrito de compras</h2>";
        echo "<table>";
        echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Acciones</th></tr>";

        $total = 0;
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['cantidad']) . "</td>";
            echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
            echo "<td>$" . number_format($subtotal, 2) . "</td>";
            echo "<td><a href='pedidos_clientes.php?id=" . $producto['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<p style='color: black'>Total: $" . number_format($total, 2) . "</p>";
    } else {
        echo "<p style='color: black'>Tu carrito está vacío.</p>";
    }

    // Lógica para eliminar un producto específico
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Buscar y eliminar el producto del carrito
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            if ($producto['id'] == $id) {
                unset($_SESSION['carrito'][$indice]);
                break;
            }
        }

        // Redirigir al carrito
        header('Location: pedidos_clientes.php');
        exit();
    }
    ?>
</section>

<footer>
    <p>Todos los derechos reservados &copy; 2024</p>
</footer>

</body>
</html>
