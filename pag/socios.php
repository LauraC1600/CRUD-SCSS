<?php
session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/socios/get.php';

$socios = obtener_socios();
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
    <title>Socios registrados</title>
</head>

<body>
    <?php $base = '../'; require __DIR__ . '/../includes/partials/header.php'; ?>

    <div class="contenedor">
    <h2>Socios registrados</h2>

    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>


            <?php while ($socio = mysqli_fetch_assoc($socios)) { ?>
                <tr>
                    <td><?php echo $socio["nombres"] ?></td>
                    <td><?php echo $socio["apellidos"] ?></td>
                    <td><?php echo $socio["cedula"] ?></td>
                    <td><?php echo $socio["telefono"] ?></td>
                    <td><?php echo $socio["direccion"] ?></td>
                </tr>
            <?php  }
            ?>

        </tbody>
    </table>
    </div>
</body>

</html>
