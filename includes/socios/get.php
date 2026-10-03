<?php

if (!function_exists('obtener_conexion')) {
    function obtener_conexion()
    {
        global $conex;

        if (!isset($conex)) {
            require_once __DIR__ . '/../../db/conexion.php';
        }

        return $conex;
    }
}

function obtener_socios()
{
    try {
        $conex = obtener_conexion();
        $sql = "SELECT * FROM socio;";
        $query = mysqli_query($conex, $sql);
        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}
