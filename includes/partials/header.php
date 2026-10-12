<?php
$base = $base ?? '';
// Nombre del archivo actual (sin .php) para ocultar el enlace de la pagina en la que ya estamos
$vistaActual = $vistaActual ?? basename($_SERVER['SCRIPT_NAME'], '.php');
?>
<header class="header">
    <div class="contenedor contenido-header">
        <h1>Sistema de Usuarios</h1>

        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <nav class="navegacion-principal">
                <?php if ($vistaActual !== 'dashboard'): ?>
                    <a href="<?= $base ?>pag/dashboard.php">Inicio</a>
                <?php endif; ?>
                <?php if ($vistaActual !== 'users'): ?>
                    <a href="<?= $base ?>pag/users.php">Usuarios</a>
                <?php endif; ?>
                <?php if (!empty($_SESSION['usuario_email'])): ?><span class="email-sesion"><?= htmlspecialchars($_SESSION['usuario_email']) ?></span><?php endif; ?>
                <a href="<?= $base ?>pag/cerrarSesion.php" class="cerrar-sesion">
                    <svg class="icono-salir" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                    </svg>
                </a>

            </nav>
        <?php endif; ?> 
    </div>
</header>