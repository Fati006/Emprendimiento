<?php
session_start();

$direc= "localhost";
$user= "root";
$pass= "";
$db= "floraliza";

$conn= mysqli_connect($direc,$user,$pass,$db);

$delete= "DELETE WHERE id_producto = $id ";
mysqli_query($conn,$delete);

header('Location: carrito.php');
exit();
?>

