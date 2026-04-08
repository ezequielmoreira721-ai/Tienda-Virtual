<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
    <title>Menú Principal</title>

</head>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<body>
<div class="container">

    <h2>Menú del Sistema</h2>

    <ul>
        <li><a href="categorias.php">Gestionar Categorías</a></li>
        <li><a href="productos.php">Gestionar Productos</a></li>
        <li><a href="graficos.php">Ver gráfico de productos</a></li>
        <li><a href="proveedores.php">Gestionar Proveedores</a></li>
        <li><a href="pedidos.php">Gestionar Pedidos</a></li>
        <li><a href="logout.php">Cerrar sesión</a></li>
    </ul>

</div>

    <img src="SOFTWAREATHOME.PNG" alt="Logo" width="300">

    
</body>
</html>