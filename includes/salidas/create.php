<?php

// function_exists evita redeclarar la funcion si otro archivo ya la definio
if (!function_exists('obtener_conexion')) {
    function obtener_conexion()
    {
        global $conex; // usa la variable de conexion.php

        if (!isset($conex)) {
            require_once __DIR__ . '/../../db/conexion.php';
        }

        return $conex;
    }
}

function insert_salida(string $fecha, string $hora, string $destino, string $matricula): bool
{
    try {
        $conex = obtener_conexion();

        $fecha     = mysqli_real_escape_string($conex, $fecha);
        $hora      = mysqli_real_escape_string($conex, $hora);
        $destino   = mysqli_real_escape_string($conex, $destino);
        $matricula = mysqli_real_escape_string($conex, $matricula);

        $sql = "INSERT INTO salidas (Fecha, Hora, Destino, Barcos_Matricula)
                VALUES ('$fecha', '$hora', '$destino', '$matricula')";

        return mysqli_query($conex, $sql);
    } catch (\Throwable $th) {
        var_dump($th);
        return false;
    }
}

function obtener_barco_por_matricula(string $matricula)
{
    try {
        $conex = obtener_conexion();

        $matricula = mysqli_real_escape_string($conex, $matricula);

        $sql = "SELECT matricula, nombre FROM barco WHERE matricula = '$matricula'";
        $query = mysqli_query($conex, $sql);

        return mysqli_fetch_assoc($query);
    } catch (\Throwable $th) {
        var_dump($th);
        return null;
    }
}
