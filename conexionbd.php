<!DOCTYPE html>
<html>
<head>
    <title>conexiondb</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container"></div>
<?php
$host = "localhost";
$usuario = "root";
$password = "";
$db = "tienda";

$conexion = mysqli_connect($host, $usuario, $password, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>