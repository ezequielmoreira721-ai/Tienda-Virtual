<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Productos por Categoría</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="estilos.css">
</head>

<?php
session_start();
include("conexionbd.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT categorias.nombre AS categoria, COUNT(productos.id) AS total
        FROM categorias
        LEFT JOIN productos ON productos.id_categoria = categorias.id
        GROUP BY categorias.nombre";

$resultado = mysqli_query($conexion, $sql);

$categorias = [];
$totales = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $categorias[] = $fila['categoria'];
    $totales[] = $fila['total'];
}
?>

<body>
<div class="container">

<h2>Productos por Categoría</h2>

<canvas id="miGrafico" width="400" height="200"></canvas>

<script>
const ctx = document.getElementById('miGrafico').getContext('2d');

const miGrafico = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($categorias); ?>,
        datasets: [{
            label: 'Cantidad de Productos',
            data: <?php echo json_encode($totales); ?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<br>
<a class="btn" href="menu.php">Volver al menú</a>

</div>
</body>
</html>