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
        <table class="dashboard">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Módulo">Usuarios</td>
                    <td data-label="Descripción">Administrar los usuarios del sistema</td>
                    <td data-label="Acción"><a class="dashboard__boton" href="users.php">Ir</a></td>
                </tr>
                <tr>
                    <td data-label="Módulo">Socios</td>
                    <td data-label="Descripción">Registro y consulta de socios</td>
                    <td data-label="Acción"><a class="dashboard__boton" href="socios.php">Ir</a></td>
                </tr>
                <tr>
                    <td data-label="Módulo">Barcos</td>
                    <td data-label="Descripción">Listado de barcos registrados</td>
                    <td data-label="Acción"><a class="dashboard__boton" href="barcos.php">Ir</a></td>
                </tr>
                <tr>
                    <td data-label="Módulo">Salidas</td>
                    <td data-label="Descripción">Control de salidas de los barcos</td>
                    <td data-label="Acción"><a class="dashboard__boton" href="salidas.php">Ir</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>