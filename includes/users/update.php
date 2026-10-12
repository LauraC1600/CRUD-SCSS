<?php
require_once __DIR__ . '/../../db/validaciones.php';
require_once __DIR__ . '/get.php';

session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../../index.php');
    exit;
}

function actualizar_usuario(int $id, string $name, string $last_name, string $cedula, string $email, string $telefono, ?string $nuevo_hash = null): bool
{
    $conex = obtener_conexion();

    $name      = mysqli_real_escape_string($conex, $name);
    $last_name = mysqli_real_escape_string($conex, $last_name);
    $cedula    = mysqli_real_escape_string($conex, $cedula);
    $email     = mysqli_real_escape_string($conex, $email);
    $telefono  = mysqli_real_escape_string($conex, $telefono);

    $sql = "UPDATE usuario SET
                nombre = '$name',
                apellido = '$last_name',
                cedula = '$cedula',
                email = '$email',
                telefono = '$telefono'";

    // Solo cambia la contraseña si se envio una nueva (hash no nulo)
    if ($nuevo_hash !== null) {
        $nuevo_hash = mysqli_real_escape_string($conex, $nuevo_hash);
        $sql .= ", contrasena = '$nuevo_hash'";
    }

    $sql .= " WHERE id = $id";

    return mysqli_query($conex, $sql);
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if (!$id) {
    header('Location: ../../pag/users.php');
    exit;
}

$conex   = obtener_conexion();
$query   = mysqli_query($conex, "SELECT * FROM usuario WHERE id = $id");
$usuario = mysqli_fetch_assoc($query);

if (!$usuario) {
    header('Location: ../../pag/users.php');
    exit;
}

$exito   = false;
$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name      = trim($_POST["name"]);
    $last_name = trim($_POST["last_name"]);
    // La cedula va "disabled" en el form (no llega en el POST), se toma de la BD
    $cedula    = $usuario['cedula'];
    $email     = trim($_POST["email"]);
    $telefono  = trim($_POST["telefono"]);

    $passActual = trim($_POST["PassA"] ?? '');
    $passNueva  = trim($_POST["NewPass"] ?? '');
    $passConf   = trim($_POST["PassC"] ?? '');

    $errores = validar_usuario_actualizar($id, $name, $last_name, $cedula, $email, $telefono);

    $nuevo_hash = null;
    // Si llena alguno de los 3 campos de clave, se exigen los 3
    $quiere_cambiar_pass = !empty($passActual) || !empty($passNueva) || !empty($passConf);

    if ($quiere_cambiar_pass) {
        if (empty($passActual) || empty($passNueva) || empty($passConf)) {
            $errores[] = "Para cambiar la contraseña debes llenar los 3 campos.";
        } elseif (!password_verify($passActual, $usuario['contrasena'])) {
            $errores[] = "La contraseña actual no coincide.";
        } elseif (strlen($passNueva) < 6) {
            $errores[] = "La nueva contraseña debe tener al menos 6 caracteres.";
        } elseif ($passNueva !== $passConf) {
            $errores[] = "La nueva contraseña y su confirmación no coinciden.";
        } else {
            $nuevo_hash = password_hash($passNueva, PASSWORD_BCRYPT);
        }
    }

    if (empty($errores)) {
        $exito = actualizar_usuario($id, $name, $last_name, $cedula, $email, $telefono, $nuevo_hash);
        if ($exito) {
            $usuario = ['nombre' => $name, 'apellido' => $last_name, 'cedula' => $cedula, 'email' => $email, 'telefono' => $telefono];
            header('Location: ../../pag/users.php?status=2');
            exit;
        }
    } else {
        $usuario = ['nombre' => $name, 'apellido' => $last_name, 'cedula' => $cedula, 'email' => $email, 'telefono' => $telefono];
    }
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
    <link rel="stylesheet" href="../../build/css/app.css">
    <title>Actualizar usuario</title>
</head>

<body>
    <?php $base = '../../'; require __DIR__ . '/../../includes/partials/header.php'; ?>

    <div class="contenedor">
    <h2>Actualizar usuario</h2>

    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?php echo $usuario['nombre'] ?>"><br>

        <label>Apellido:</label>
        <input type="text" name="last_name" value="<?php echo $usuario['apellido'] ?>"><br>

        <label>Cédula:</label>
        <input type="text" name="cedula" value="<?php echo $usuario['cedula'] ?>" disabled><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $usuario['email'] ?>"><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $usuario['telefono'] ?>"><br>

        <label>Contraseña Actual:</label>
        <input type="password" name="PassA"><br>

        <label>Nueva Contraseña:</label>
        <input type="password" name="NewPass"><br>

        <label>Confirmar Contraseña:</label>
        <input type="password" name="PassC"><br>

        <button type="submit">Guardar cambios</button>
    </form>

    <a href="../../pag/users.php">Volver</a>

    </div>

    <?php $base = '../../'; require __DIR__ . '/../../includes/partials/alertas.php'; ?>
</body>

</html>
