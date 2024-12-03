<?php
$direc = "localhost";
$user = "root";
$pass = "";
$db = "floraliza";

// Conexión a la base de datos
$conn = mysqli_connect($direc, $user, $pass, $db);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$directorio_fotos = '/admin/fotos/';


// Recoger los datos del formulario (asegúrate de que se envíen correctamente)
$nombre = mysqli_real_escape_string($conn, $_POST['nombre']); // nombre del producto
$precio = mysqli_real_escape_string($conn, $_POST['precio']);  // precio
$cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']); // cantidad

// Subir la imagen
if (isset($_FILES['imagen'])) {
    $nombre_imagen = $_FILES['imagen']['name'];
    $tmp_imagen = $_FILES['imagen']['tmp_name'];
    $ruta_imagen = $directorio_fotos . basename($nombre_imagen);

    // Verificar si el archivo es una imagen válida (esto es opcional)
    $ext_imagen = strtolower(pathinfo($ruta_imagen, PATHINFO_EXTENSION));
    $extensiones_validas = array('jpg', 'jpeg', 'png', 'gif');
    
    if (in_array($ext_imagen, $extensiones_validas)) {
        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($tmp_imagen, $ruta_imagen)) {
            echo "La imagen se ha subido correctamente.";
            echo '<a href="Carga_productos.html">Volver al inicio</a>';
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    } else {
        echo "Formato de imagen no válido. Solo se aceptan jpg, jpeg, png, y gif.";
        exit();
    }
} else {
    echo "No se ha seleccionado ninguna imagen.";
    exit();
}

// Insertar el producto en la base de datos con la ruta de la imagen
$sql = "INSERT INTO `producto` (`nombre`, `precio`, `cantidad`, `imagen`) 
        VALUES ('$nombre', '$precio', '$cantidad', '$ruta_imagen')";

if ($conn->query($sql) === TRUE) {
    echo "Producto cargado correctamente.";
} else {
    echo "Error al cargar el producto: " . $conn->error;
}

$conn->close();
?>
