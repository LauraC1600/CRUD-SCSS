<?php
session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/barcos/get.php';

$barcos = obtener_barcos();
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
    <h2>Barcos registrados</h2>

    <table>
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Amarre</th>
                <th>Cuota</th>
                <th>Socio</th>
            </tr>
        </thead>
        <tbody>


            <?php while ($barco = mysqli_fetch_assoc($barcos)) { ?>
                <tr>
                    <td><?php echo $barco["matricula"] ?></td>
                    <td><?php echo $barco["nombre"] ?></td>
                    <td><?php echo $barco["n_amarre"] ?></td>
                    <td><?php echo $barco["cuota_amarre"] ?></td>
                    <td><?php echo $barco["socio_nombres"] . ' ' . $barco["socio_apellidos"] ?></td>
                </tr>
            <?php  }
            ?>

        </tbody>
    </table>
    </div>
</body>

</html>
