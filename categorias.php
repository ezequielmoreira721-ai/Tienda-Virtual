<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("conexionbd.php");

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
    mysqli_query($conexion, $sql);

 
    header("Location: categorias.php");
    exit();
}

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    mysqli_query($conexion, "DELETE FROM categorias WHERE id=$id");

    header("Location: categorias.php");
    exit();
}
?>

<body>
<div class="container">

    <h1>Gestión de Categorías</h1>

    <form method="POST">
        <label>Nombre de categoría:</label>
        <input type="text" name="nombre" required>
        <button type="submit">Agregar</button>
    </form>

    <hr>

    <h2>Listado de Categorías</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>

        <?php
        $resultado = mysqli_query($conexion, "SELECT * FROM categorias");

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>".$fila['id']."</td>";
            echo "<td>".$fila['nombre']."</td>";
            echo "<td>
                    <a class='btn' href='categorias.php?eliminar=".$fila['id']."'>Eliminar</a>
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