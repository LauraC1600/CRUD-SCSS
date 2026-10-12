<?php

session_start();
if(empty($_SESSION['usuario_id']) ){
 header('Location: ../index.php');
 exit;
}

require_once __DIR__ . '/../db/validaciones.php';
require_once __DIR__ . '/../includes/users/create.php';


$errores = [];
$exito = false;
$mensaje_exito = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name               = trim($_POST["name"]);
    $last_name          = trim($_POST["last_name"]);
    $cedula             = trim($_POST["cedula"]);
    $email              = trim($_POST["email"]);
    $passwore           = trim($_POST["passwore"]);
    $confirmar_passwore = trim($_POST["confirmar_passwore"]);
    $telefono           = trim($_POST["telefono"]);

    $errores = validar_usuario($name, $last_name, $cedula, $email, $passwore, $confirmar_passwore, $telefono);

    if (empty($errores)) {
        $exito = insert_usuario($name, $last_name, $cedula, $email, $passwore, $telefono);
        if ($exito) {
            $mensaje_exito = 'Usuario agregado correctamente';
            $name = $last_name = $cedula = $email = $passwore = $confirmar_passwore = $telefono = '';
        }
    }
}


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
    <title>Nuevo usuario</title>
</head>

<body>
    <?php $base = '../'; require __DIR__ . '/../includes/partials/header.php'; ?>

    <div class="contenedor">

    <h2>Agregar usuario</h2>


    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?php echo $name ?? '' ?>"><br>

        <label>Apellido:</label>
        <input type="text" name="last_name" value="<?php echo $last_name ?? '' ?>"><br>

        <label>Cédula:</label>
        <input type="text" name="cedula" value="<?php echo $cedula ?? '' ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email ?? '' ?>"><br>
        
        <label>Contraseña:</label>
        <input type="password" name="passwore"><br>

        <label>Confirmar Contraseña:</label>
        <input type="password" name="confirmar_passwore"><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $telefono ?? '' ?>"><br>

        <button type="submit">Agregar</button>
    </form>

    </div>

    <?php $base = '../'; require __DIR__ . '/../includes/partials/alertas.php'; ?>
</body>

</html>