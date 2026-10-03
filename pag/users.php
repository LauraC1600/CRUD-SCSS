<?php
session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/users/get.php';

$usuarios = obtener_usuarios();
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
    <title>Usuarios registrados</title>
</head>

<body>
    <?php $base = '../'; require __DIR__ . '/../includes/partials/header.php'; ?>

    <div class="contenedor">
    <h2>Usuarios registrados</h2>

    <?php

    $mensajes_status = [
        2 => ['ok', 'Usuario actualizado correctamente.'],
        3 => ['error', 'No se pudo actualizar: revisa los datos del formulario.'],
        4 => ['ok', 'Usuario eliminado correctamente.'],
        5 => ['error', 'No se pudo eliminar el usuario.'],
    ];
    $status = isset($_GET['status']) ? (int) $_GET['status'] : 0;
    if (isset($mensajes_status[$status])):
        [$tipo, $texto] = $mensajes_status[$status];
    ?>
        <p style="color: <?= $tipo === 'ok' ? 'green' : 'red' ?>;"><?= $texto ?></p>
    <?php endif; ?>

    <a href="../form/registrar.php">Nuevo Usuario</a>
    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cedula</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>opciones</th>
            </tr>
        </thead>
        <tbody>


            <?php while ($user = mysqli_fetch_assoc($usuarios)) { ?>
                <tr>
                    <td><?php echo $user["nombre"] ?></td>
                    <td><?php echo $user["apellido"] ?></td>
                    <td><?php echo $user["cedula"] ?></td>
                    <td><?php echo $user["email"] ?></td>
                    <td><?php echo $user["telefono"] ?></td>
                    <?php $id = $user["id"] ?>
                    <td> <a href="../includes/users/update.php?id=<?php echo $id; ?>">Update</a> | 
                    <a href="../includes/users/delete.php?id=<?php echo $id; ?>" onclick="return confirm('¿Está seguro de eliminar este registro?');">Delete</a></td>
                </tr>
            <?php  } 
            ?>

        </tbody>
    </table>
    </div>
</body>

</html>