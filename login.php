
<?php

session_start();

$direccion = "localhost";
$usuario = "root";
$contraseña = "";
$dbname = "floraliza";

$conn = mysqli_connect($direccion, $usuario, $contraseña, $dbname);


if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin']) {
        header("Location: panel.html");
        exit();
    } else {
        header("Location: main.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['contraseña']);

    if ($password === '12345') {
        if ($name === 'flora') {
            $_SESSION['is_admin'] = true;
            header("Location: admin/panel.html");
            exit();
        } 
    } else {
        $_SESSION['is_admin'] = false;
        header("Location: main.php");
        $Insert_Usuarios = "INSERT INTO `usuarios` (`usuario`, `contraseña usuarios`) VALUES ('$name','$password')";
        $hacer= mysqli_query($conn, $Insert_Usuarios);
        exit();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Logeo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="my-login-page">
    <style>
        body {
            background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnMTpt4v2-s85V6YimpUfJlvHqij0jvRwJqA&s);
            background-repeat: no-repeat;
            background-size: 1380px;
            
        }
    </style>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Inicio de sesión</h4>
                            <form method="POST" class="my-login-validation" novalidate="" id="login">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" type="name" class="form-control" name="name" required autofocus>
                                    <div class="invalid-feedback">
                                        Correo electrónico inválido
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="contraseña" required data-eye>
                                    <div class="invalid-feedback">
                                        Contraseña requerida
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                        <label for="remember" class="custom-control-label">¿Recordar esta contraseña?</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Inicio
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2024 &mdash; Floraliza
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>
</html>