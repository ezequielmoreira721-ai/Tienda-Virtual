<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("conexionbd.php");

if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['id_categoria'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "INSERT INTO productos (nombre, precio, id_categoria)
            VALUES ('$nombre', '$precio', '$id_categoria')";
    mysqli_query($conexion, $sql);

    header("Location: productos.php");
    exit();
}


if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    mysqli_query($conexion, "DELETE FROM productos WHERE id=$id");

    header("Location: productos.php");
    exit();
}

$por_pagina = 5;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $por_pagina;
?>

<body>
<div class="container">

<h2>Gestión de Productos</h2>

<h3>Buscar Producto</h3>
<form method="GET">
    <input type="text" name="buscar" placeholder="Buscar por nombre">
    <button type="submit">Buscar</button>
</form>

<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required>

    <label>Categoría:</label>
    <select name="id_categoria" required>
        <option value="">Seleccione una categoría</option>
        <?php
        $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
        while ($cat = mysqli_fetch_assoc($categorias)) {
            echo "<option value='".$cat['id']."'>".$cat['nombre']."</option>";
        }
        ?>
    </select>

    <button type="submit">Agregar Producto</button>
</form>

<hr>

<h3>Listado de Productos</h3>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Categoría</th>
    <th>Acción</th>
</tr>

<?php

if (isset($_GET['buscar']) && $_GET['buscar'] != "") {
    $buscar = $_GET['buscar'];
    $sql = "SELECT productos.id, productos.nombre, productos.precio, categorias.nombre AS categoria
            FROM productos
            INNER JOIN categorias ON productos.id_categoria = categorias.id
            WHERE productos.nombre LIKE '%$buscar%'
            LIMIT $inicio, $por_pagina";
} else {
    $sql = "SELECT productos.id, productos.nombre, productos.precio, categorias.nombre AS categoria
            FROM productos
            INNER JOIN categorias ON productos.id_categoria = categorias.id
            LIMIT $inicio, $por_pagina";
}

$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>".$fila['id']."</td>";
    echo "<td>".$fila['nombre']."</td>";
    echo "<td>".$fila['precio']."</td>";
    echo "<td>".$fila['categoria']."</td>";
    echo "<td>
            <a class='btn' href='productos.php?eliminar=".$fila['id']."'>Eliminar</a>
          </td>";
    echo "</tr>";
}
?>
</table>

<?php

if (isset($_GET['buscar']) && $_GET['buscar'] != "") {
    $buscar = $_GET['buscar'];
    $total_sql = "SELECT COUNT(*) as total FROM productos WHERE nombre LIKE '%$buscar%'";
} else {
    $total_sql = "SELECT COUNT(*) as total FROM productos";
}

$total_result = mysqli_query($conexion, $total_sql);
$total_fila = mysqli_fetch_assoc($total_result);
$total_registros = $total_fila['total'];

$total_paginas = ceil($total_registros / $por_pagina);
?>

<br>
<div>
<?php
for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<a class='btn' href='productos.php?pagina=$i'>$i</a> ";
}
?>
</div>

<br>
<a class="btn" href="menu.php">Volver al menú</a>

</div>

      <img src="SOFTWAREATHOME.PNG" alt="Logo" width="300">

</body>
</html>