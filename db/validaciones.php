<?php

require_once __DIR__ . '/../includes/users/get.php';

function validar_usuario_pass(string $email, string $passwore): array
{
    $errores = [];

    // filter_var valida el formato del email con el filtro nativo de PHP
    if (empty($email)) $errores[] = "El email es obligatorio.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El email no es válido.";
    elseif (!email_existe($email)) $errores[] = "Informacion incorrecta";
    if (empty($passwore)) $errores[] = "La contraseña es obligatoria.";

    return $errores;
}





function validar_usuario(string $name, string $last_name, string $cedula, string $email, string $passwore, string $confirmar_passwore, string $telefono): array
{
    $errores = [];

    if (empty($name))      $errores[] = "El nombre es obligatorio.";
    elseif (!is_string($name) || is_numeric($name)) $errores[] = "El nombre debe ser solo texto";
    if (empty($last_name)) $errores[] = "El apellido es obligatorio.";
    elseif (!is_string($last_name) || is_numeric($last_name)) $errores[] = "El apellido debe ser solo texto";
    if (empty($cedula))    $errores[] = "La cédula es obligatoria.";
    // ctype_digit: true solo si el texto son puros digitos
    elseif (!ctype_digit($cedula)) $errores[] = "La cédula debe contener solo números.";
    elseif (cedula_existe($cedula)) $errores[] = "La cedula ya está registrada.";
    elseif (strlen((string)$cedula) < 9) $errores[] = "La cedula debe ser minimo de 9 dijitos";
    elseif (strlen($cedula) > 10) $errores[] = "La cedula debe ser máximo de 10 dijitos";
    // mb_strlen cuenta caracteres reales (tildes, ñ); strlen cuenta bytes
    if (mb_strlen($name) > 50)      $errores[] = "El nombre admite máximo 50 caracteres.";
    if (mb_strlen($last_name) > 50) $errores[] = "El apellido admite máximo 50 caracteres.";
    if (mb_strlen($email) > 100)    $errores[] = "El email admite máximo 100 caracteres.";
    if (strlen($telefono) > 15)     $errores[] = "El telefono debe ser máximo de 15 dijitos";
    if (empty($email))     $errores[] = "El email es obligatorio.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "formato de correo incorrecto.";
    elseif (email_existe($email)) $errores[] = "El email ya está registrado.";
    if (empty($passwore))  $errores[] = "La contraseña es obligatoria.";
    elseif (strlen($passwore) < 6) $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    elseif ($passwore !== $confirmar_passwore) $errores[] = "Datos invalidos.";
    if (empty($telefono))  $errores[] = "El teléfono es obligatorio.";
    elseif (strlen((string)$telefono) < 9) $errores[] = "El telefono debe ser minimo de 9 dijitos";

    return $errores;
}


// Igual que validar_usuario pero ignora al propio usuario ($id) al buscar cedula/email repetidos
function validar_usuario_actualizar(int $id, string $name, string $last_name, string $cedula, string $email, string $telefono): array
{
    $errores = [];

    if (empty($name))      $errores[] = "El nombre es obligatorio.";
    elseif (!is_string($name) || is_numeric($name)) $errores[] = "El nombre debe ser solo texto";
    if (empty($last_name)) $errores[] = "El apellido es obligatorio.";
    elseif (!is_string($last_name) || is_numeric($last_name)) $errores[] = "El apellido debe ser solo texto";
    if (empty($cedula))    $errores[] = "La cédula es obligatoria.";
    elseif (!ctype_digit($cedula)) $errores[] = "La cédula debe contener solo números.";
    elseif (cedula_existe($cedula, $id)) $errores[] = "La cedula ya está registrada.";
    elseif (strlen((string)$cedula) < 9) $errores[] = "La cedula debe ser minimo de 9 dijitos";
    elseif (strlen($cedula) > 10) $errores[] = "La cedula debe ser máximo de 10 dijitos";
    if (mb_strlen($name) > 50)      $errores[] = "El nombre admite máximo 50 caracteres.";
    if (mb_strlen($last_name) > 50) $errores[] = "El apellido admite máximo 50 caracteres.";
    if (mb_strlen($email) > 100)    $errores[] = "El email admite máximo 100 caracteres.";
    if (strlen($telefono) > 15)     $errores[] = "El telefono debe ser máximo de 15 dijitos";
    if (empty($email))     $errores[] = "El email es obligatorio.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "formato de correo incorrecto.";
    elseif (email_existe($email, $id)) $errores[] = "El email ya está registrado.";
    if (empty($telefono))  $errores[] = "El teléfono es obligatorio.";
    elseif (strlen((string)$telefono) < 9) $errores[] = "El telefono debe ser minimo de 9 dijitos";

    return $errores;
}
