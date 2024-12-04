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

    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        echo "<h2 style= 'color: black'>Tu carrito de compras</h2>";
        echo "<table>";
        echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Acciones</th></tr>";

        $total = 0;
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            $subtotal = (float)$producto['precio'] * (int)$producto['cantidad'];
            $total += $subtotal;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['cantidad']) . "</td>";
            echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
            echo "<td>$" . number_format($subtotal, 2) . "</td>";
            echo "<td><a href='eliminar_producto.php?id=" . $producto['id_producto'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<p style='color: black'>Total: $" . number_format($total, 2) . "</p>";
        echo "<form method='POST' action=''>
                        <input type='hidden' name='id_producto' value='" . $producto['id_producto'] . "'>
                        <input type='hidden' name='nombre' value='" . $producto['nombre'] . "'>
                        <input type='hidden' name='precio' value='" . $producto['precio'] . "'>
                        <input type='hidden' name='imagen' value='" . $producto['imagen'] . "'>
                        <input type='hidden' name='cantidad' min='1' max='" . $producto['cantidad'] . "' value='1'>
                        <button type='submit' name='agregar'>Enviar pedido</button>
        </form>";

        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "floraliza";

        $conn = mysqli_connect($host, $user, $password, $db);
            $id_producto= $_POST['id_producto'];
            $nombre= $_POST['nombre'];
            $cantidad= $_POST['cantidad'];
            $precio= $_POST['precio'];
            
            $Insert="INSERT INTO `pedidos` (`id_producto`,`nombre`,`cantidad`,`precio`) VALUES ('$id_producto','$nombre','$cantidad','$precio')";
            $asegurar= mysqli_query($conn, $Insert);
    

    } else {
        echo "<p style='color: black'>Tu carrito está vacío.</p>";
    }

    ?>
</section>

<footer>
    <p>Todos los derechos reservados &copy; Floraliza 2024</p>
</footer>

</body>
</html>