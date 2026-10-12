<?php
session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/salidas/get.php';

$barcos = obtener_salidas();
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
    <title>Barcos registrados</title>
</head>

<body>
    <?php $base = '../'; require __DIR__ . '/../includes/partials/header.php'; ?>

    <div class="contenedor">
    <h2>salidas</h2>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Destino</th>
                <th>Matricula</th>
            </tr>
        </thead>
        <tbody>


            <?php while ($salida = mysqli_fetch_assoc($barcos)) { ?>
                <tr>
                    <td><?php echo $salida["Fecha"] ?></td>
                    <td><?php echo $salida["Hora"] ?></td>
                    <td><?php echo $salida["Destino"] ?></td>
                    <td><?php echo $salida["Matricula"] ?></td>
                </tr>
            <?php  }
            ?>

        </tbody>
    </table>
    </div>
</body>
</html>
