<?php

session_start();

// Vacia los datos de sesion para cerrarla (session_destroy() seria mas completo)
$_SESSION['usuario_id']    = [];
$_SESSION['usuario_email'] = [];

header('Location:  ../index.php');
exit;
