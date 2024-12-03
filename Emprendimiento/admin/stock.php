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
