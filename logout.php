<!DOCTYPE html>
<html>
<head>
    <title>logout</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
session_start();
session_destroy();
header("Location: login.php");
exit();