<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "floraliza";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta corregida
$quer = "
    SELECT 
        pedidos.id_pedido, 
        usuarios.usuario AS nombre_usuario,
        producto.nombre AS nombre_producto,
        producto.id_producto,
        pedidos.cantidad,
        pedidos.precio
    FROM 
        pedidos
    INNER JOIN 
        usuarios ON pedidos.id_pedido = usuarios.id_usuario
    INNER JOIN 
        producto ON pedidos.id_producto = producto.id_producto
";

$result = mysqli_query($conn, $quer);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 80%; margin: 20px auto; text-align: left;'>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th>ID Pedido</th>";
    echo "<th>ID Usuario</th>";
    echo "<th>Producto</th>";
    echo "<th>ID Producto</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Precio</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_pedido']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre_producto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_producto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>$" . number_format($row['precio'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No hay pedidos registrados.</p>";
}

mysqli_close($conn);
?>
