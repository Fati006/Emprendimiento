<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
</head>
<body>
    <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #d7fff5;
        color: #333;
        margin: 0;
        padding: 0;
    }

    h2 , h5{
        text-align: center;
        margin-top: 20px;
        color: #3eb36f;
    }
    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f4f4f4;
        color: #333;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    table td img {
        display: block;
        max-width: 50px;
        height: auto;
        margin-right: 10px;
        border-radius: 5px;
    }

    </style>
</body>
</html>

<?php
// Configuración de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$db = "floraliza";

// Conectar a la base de datos
$conn = mysqli_connect($host, $user, $password, $db);

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para obtener todos los productos
$query = "SELECT * FROM producto";
$result = mysqli_query($conn, $query);

// Verificar si hay productos
if ($result->num_rows > 0) {
    echo "<h2>Stock de productos</h2>";
    echo "<h5>Recuerde, todo producto eliminado/editado se eliminara/editara de la base de datos</h5>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 90%; margin: 20px auto; text-align: left;'>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th>ID Producto</th>";
    echo "<th>Nombre</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Precio</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    // Mostrar productos
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_producto'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['cantidad'] . "</td>";
        echo "<td>$" . number_format($row['precio'], 2) . "</td>";
        echo "<td>";
        echo "<a href='editar_producto.php?id=" . $row['id_producto'] . "' style='color: blue; text-decoration: none; margin-right: 10px;'>Editar</a>";
        echo "<a href='eliminar_producto.php?id=" . $row['id_producto'] . "' style='color: red; text-decoration: none;' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\");'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No hay productos en stock.</p>";
}

// Cerrar conexión
mysqli_close($conn);
?>
