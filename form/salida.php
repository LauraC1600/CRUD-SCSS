<?php
session_start();
if (empty($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/salidas/create.php';

// Toma la matricula de la URL (GET) o del formulario (POST), lo que exista primero
$matricula = trim($_GET['matricula'] ?? $_POST['matricula'] ?? '');
$barco = $matricula !== '' ? obtener_barco_por_matricula($matricula) : null;

if (!$barco) {
    header('Location: ../pag/barcos.php');
    exit;
}

$errores = [];
$exito = false;
$mensaje_exito = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha   = trim($_POST["fecha"] ?? '');
    $hora    = trim($_POST["hora"] ?? '');
    $destino = trim($_POST["destino"] ?? '');

    if ($fecha === '') {
        $errores[] = 'La fecha es obligatoria';
    }
    if ($hora === '') {
        $errores[] = 'La hora es obligatoria';
    }
    if ($destino === '') {
        $errores[] = 'El destino es obligatorio';
    }

    if (empty($errores)) {
        $exito = insert_salida($fecha, $hora, $destino, $barco['matricula']);
        if ($exito) {
            $mensaje_exito = 'Se registró la salida correctamente';
            $fecha = $hora = $destino = '';
        } else {
            $errores[] = 'No se pudo registrar la salida';
        }
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
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Nueva salida</title>
</head>

<body>
    <?php $base = '../'; require __DIR__ . '/../includes/partials/header.php'; ?>

    <div class="contenedor">

    <!-- htmlspecialchars evita XSS al imprimir datos en el HTML -->
    <h2>Dar salida a <?php echo htmlspecialchars($barco['nombre']) ?> (<?php echo htmlspecialchars($barco['matricula']) ?>)</h2>

    <form method="POST" action="">
        <input type="hidden" name="matricula" value="<?php echo htmlspecialchars($barco['matricula']) ?>">

        <label>Fecha:</label>
        <input type="date" name="fecha" value="<?php echo htmlspecialchars($fecha ?? date('Y-m-d')) ?>"><br>

        <label>Hora:</label>
        <input type="time" name="hora" value="<?php echo htmlspecialchars($hora ?? date('H:i')) ?>"><br>

        <label>Destino:</label>
        <input type="text" name="destino" value="<?php echo htmlspecialchars($destino ?? '') ?>"><br>

        <button type="submit">Registrar salida</button>
        <a href="../pag/barcos.php">Volver</a>
    </form>

    </div>

    <?php $base = '../'; require __DIR__ . '/../includes/partials/alertas.php'; ?>
</body>

</html>
