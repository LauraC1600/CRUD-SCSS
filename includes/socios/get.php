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
