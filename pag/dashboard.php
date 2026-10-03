<?php
session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>inicio</title>
</head>

<body>
    <?php $base = '../'; require __DIR__ . '/../includes/partials/header.php'; ?>

    <div class="contenedor">
        <h2>Listado de opciones</h2>
        <nav>
            <a href="users.php">Usuarios</a>
            <a href="socios.php">Socios</a>
            <a href="barcos.php">Barcos</a>
            <a href="salidas.php">Salidas</a>
        </nav>
    </div>
</body>

</html>