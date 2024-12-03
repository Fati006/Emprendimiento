<?php
// Configuración de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$db = "floraliza";

// Conexión a la base de datos
$conn = mysqli_connect($host, $user, $password, $db);

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para obtener los datos de los pedidos
$quer = "SELECT pedidos.id_usuario, usuario.id_usuario AS usuario, producto.id_producto AS producto, pedidos.precio pedidos.cantidad  FROM pedidos INNER JOIN producto ON pedidos.id_producto = producto.id_producto INNER JOIN usuario ON pedidos.id_usuario = usuarios.id_usuario";

$result = mysqli_query($conn, $quer);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 80%; margin: 20px auto; text-align: left;'>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th>ID Pedido</th>";
    echo "<th>Usuario</th>";
    echo "<th>Producto</th>";
    echo "<th>ID Producto</th>";
    echo "<th>Cantidad</th>";
    echo "</tr>";

    // Recorrer resultados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_pedido'] . "</td>";
        echo "<td>" . $row['usuario'] . "</td>";
        echo "<td>" . $row['producto'] . "</td>";
        echo "<td>" . $row['id_producto'] . "</td>";
        echo "<td>" . $row['cantidad'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No hay pedidos registrados.</p>";
}

// Cerrar conexión
mysqli_close($conn);
?>
