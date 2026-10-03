<?php
session_start();
require_once __DIR__ . '/includes/users/get.php';
require_once __DIR__ . '/db/funciones.php';


$errores = [];
$email   = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"]    ?? '');
    $passwore = trim($_POST["passwore"] ?? '');

    $errores = validar_usuario_pass($email, $passwore);

    if (empty($errores)) {
        $usuario = login($email, $passwore);

        if ($usuario) {
            $_SESSION['usuario_id']    = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header('Location: pag/dashboard.php');
            exit;
        } else {
            $errores[] = "informacion incorrecta.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Login</title>
</head>
<body>

    <?php $base = ''; require __DIR__ . '/includes/partials/header.php'; ?>

    <main class="login">
    <div class="contenedor">
    <div class="login__caja">

        <h2>Iniciar sesión</h2>

        <?php if (!empty($errores)): ?>
            <div class="login__errores">
                <?php foreach ($errores as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="login__form" method="POST" action="">

            <label>Email:</label>
            <input type="email" name="email" value="<?= $email ?>">
            

            <label>Contraseña:</label>
            <input type="password" name="passwore">
            

            <button type="submit">Ingresar</button>

        </form>

    </div>
    </div>
    </main>

</body>
</html>