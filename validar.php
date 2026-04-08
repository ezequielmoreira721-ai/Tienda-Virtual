<!DOCTYPE html>
<html>
<head>
    <title>validar</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container"></div>
<?php
session_start();
    include("conexionbd.php");

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['usuario'] = $usuario;
    header("Location: menu.php");
} else {
    echo "Usuario o contraseña incorrectos";
}
?>