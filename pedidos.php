<!DOCTYPE html>
<html>
<head>
    <title>Pedidos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<?php
session_start();
include("conexionbd.php");


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}


if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM pedidos WHERE id=$id";
    mysqli_query($conexion, $sql);

    header("Location: pedidos.php");
    exit();
}

if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $id_proveedor = $_POST['id_proveedor'];

    $sql = "INSERT INTO pedidos (fecha, id_proveedor)
            VALUES ('$fecha', '$id_proveedor')";
    mysqli_query($conexion, $sql);

    header("Location: pedidos.php");
    exit();
}
?>

<body>
<div class="container">

<h2>Gestión de Pedidos</h2>

<form method="POST">
    <label>Fecha:</label>
    <input type="date" name="fecha" required>

    <label>Proveedor:</label>
    <select name="id_proveedor" required>
        <option value="">Seleccione un proveedor</option>
        <?php
        $sql_prov = "SELECT * FROM proveedores";
        $res_prov = mysqli_query($conexion, $sql_prov);
        while ($prov = mysqli_fetch_assoc($res_prov)) {
            echo "<option value='".$prov['id']."'>".$prov['nombre']."</option>";
        }
        ?>
    </select>

    <button type="submit">Crear Pedido</button>
</form>

<hr>

<h3>Listado de Pedidos</h3>

<table>
<tr>
    <th>ID</th>
    <th>Fecha</th>
    <th>Proveedor</th>
    <th>Acción</th>
</tr>

<?php
$sql = "SELECT pedidos.id, pedidos.fecha, proveedores.nombre AS proveedor
        FROM pedidos
        INNER JOIN proveedores ON pedidos.id_proveedor = proveedores.id";

$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>".$fila['id']."</td>";
    echo "<td>".$fila['fecha']."</td>";
    echo "<td>".$fila['proveedor']."</td>";
    echo "<td>
            <a class='btn' href='pedidos.php?eliminar=".$fila['id']."'>Eliminar</a>
          </td>";
    echo "</tr>";
}
?>
</table>

<br>
<a class="btn" href="menu.php">Volver al menú</a>

</div>
</body>
</html>