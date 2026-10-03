<?php
$base = $base ?? '';
?>
<header class="header">
    <div class="contenedor contenido-header">
        <h1>Sistema de Usuarios</h1>

        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <nav class="navegacion-principal">
                <a href="<?= $base ?>pag/dashboard.php">Inicio</a>
                <a href="<?= $base ?>pag/users.php">Usuarios</a>
                <a href="<?= $base ?>pag/cerrarSesion.php">
                    Cerrar sesión<?= !empty($_SESSION['usuario_email']) ? ' (' . htmlspecialchars($_SESSION['usuario_email']) . ')' : '' ?>
                </a>
            </nav>
        <?php endif; ?>
    </div>
</header>
