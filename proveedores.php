 <!DOCTYPE html>
<html>
<head>
    <title>Proveedores</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<?php
session_start();
include("conexionbd.php");


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO proveedores (nombre, telefono, direccion)
            VALUES ('$nombre', '$telefono', '$direccion')";
    mysqli_query($conexion, $sql);

    header("Location: proveedores.php");
    exit();
}


if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM proveedores WHERE id=$id";
    mysqli_query($conexion, $sql);

    header("Location: proveedores.php");
    exit();
}
?>

<body>
<div class="container">

<h2>Gestión de Proveedores</h2>

<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono">

    <label>Dirección:</label>
    <input type="text" name="direccion">

    <button type="submit">Agregar Proveedor</button>
</form>

<hr>

<h3>Listado de Proveedores</h3>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Teléfono</th>
    <th>Dirección</th>
    <th>Acción</th>
</tr>

<?php
$sql = "SELECT * FROM proveedores";
$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>".$fila['id']."</td>";
    echo "<td>".$fila['nombre']."</td>";
    echo "<td>".$fila['telefono']."</td>";
    echo "<td>".$fila['direccion']."</td>";
    echo "<td>
            <a class='btn' href='proveedores.php?eliminar=".$fila['id']."'>Eliminar</a>
          </td>";
    echo "</tr>";
}
?>
</table>

<br>
<a class="btn" href="menu.php">Volver al menú</a>

</div>      

        <img src="SOFTWAREATHOME.PNG" alt="Logo" width="300">


</body>
</html>