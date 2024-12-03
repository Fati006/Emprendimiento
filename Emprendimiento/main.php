<?php
session_start(); // Iniciar sesión para el carrito

// Verificar si el carrito ya existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array(); // Crear el carrito si no existe
}

// Función para agregar productos al carrito
function agregarAlCarrito($id_producto, $nombre, $cantidad, $precio, $imagen) {
    // Comprobar si el producto ya está en el carrito
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['id_producto'] == $id_producto) {
            $producto['cantidad'] += $cantidad; // Si ya existe, solo aumentar la cantidad
            $encontrado = true;
            break;
        }
    }

    // Si no está en el carrito, agregarlo
    if (!$encontrado) {
        $_SESSION['carrito'][] = array(
            'id_producto' => $id_producto,
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'imagen' => $imagen
        );
    }
}

if (isset($_POST['agregar'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    agregarAlCarrito($id_producto, $nombre, $cantidad, $precio, $imagen);
}

?>
<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Floraliza</title>
</head>
<body>
    <header>
        <h1 style= "color: rgb(103, 214, 180); text-align: left; font-family: Arial; font-weight: bolder;">FLORALIZA</h1>
        <a href="Cerrar_Sesion.php">Cerrar Sesión ||</a>
        <a href="pedidos_clientes.php">Ver Carrito ||</a>
        <a href="info.html">Sobre nosotros</a>
    </header>
    <style>
        img {
            width: 300px;
            height: 300px;
            display: center;
        }
        div {
            background-color: white;
            margin: 20px;
            padding: 5%;
        }
        section {
        }
        .producto {
            width: 300px;
            margin-right: auto;
            display: inline-block;
        }
        input[type="number"] {
            width: 50px;
            padding: 5px;
            margin: 10px 0;
        }
        button {
            background-color: green;
            color: white;
            border-radius: 5%;
            padding: 10px 15px;
            font-weight: bold;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
    <section>
      
    </section>
</body>
</html>

<?php
$direc = "localhost";
$user = "root";
$password = "";
$bd = "floraliza";

// Conectar a la base de datos
$conn = mysqli_connect($direc, $user, $password, $bd);
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para obtener los productos
$Select = "SELECT * FROM producto";
$result = mysqli_query($conn, $Select);
$Select2= "SELECT `id_usuario` FROM `usuarios`";

// Verificar si hay productos en la base de datos
if ($result->num_rows > 0) {
    // Mostrar cada producto
    while ($row = $result->fetch_assoc()) {
        echo "<div class='producto'>"; // Agrupar el producto en un contenedor
        // Mostrar la imagen del producto
        echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "' />";

        // Mostrar el nombre del producto
        echo "<h3 style='font-weight: bolder;'>" . $row['nombre'] . "</h3>";

        // Mostrar la cantidad en stock
        echo "<h4 style='font-weight: bolder;'>Stock disponible: " . $row['cantidad'] . "</h4>";

        // Mostrar el precio del producto
        echo "<p style='font-weight: bolder; font-size: larger;'>Precio: $" . number_format($row['precio'], 2) . "</p>";
        
        // Formulario para agregar al carrito
        echo "<form method='POST' action=''>
                        <input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>
                        <input type='hidden' name='nombre' value='" . $row['nombre'] . "'>
                        <input type='hidden' name='precio' value='" . $row['precio'] . "'>
                        <input type='hidden' name='imagen' value='" . $row['imagen'] . "'>
                        <input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>
                        <label for='cantidad'>Cantidad:</label>
                        <input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' value='1'>
                        <button type='submit' name='agregar'>Añadir al carrito</button>
                    </form>";

        echo "</div>"; // Cerrar el contenedor del producto
    }
} else {
    // Si no hay productos en la base de datos
    echo "<p>No hay productos disponibles.</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
