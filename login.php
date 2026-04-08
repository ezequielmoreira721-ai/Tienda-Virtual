<!DOCTYPE html>
<html>
<head>
    <title>Login del Sistema</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container" style="max-width:400px; margin-top:80px;">

    <h1>Iniciar Sesión</h1>

    <form action="validar.php" method="POST">
        <label>Usuario:</label>
        <input type="text" name="usuario" placeholder="Ingrese su usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="password" placeholder="Ingrese su contraseña" required>

        <button type="submit">Ingresar</button>
    </form>

</div>  

<div style="display:flex; justify-content: space-between; align-items: center; padding: 40px;">
    
    <img src="SOFTWAREATHOME.PNG" alt="Logo" width="400">
    <video width="400" autoplay muted loop controls>
    <source src="Cinta.MP4" type="video/mp4">
</video>
</body>
</html>


<?php
session_start();
?>
