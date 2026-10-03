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

function obtener_barcos()
{
    try {
        $conex = obtener_conexion();
        $sql = "SELECT barco.*, socio.nombres AS socio_nombres, socio.apellidos AS socio_apellidos
                FROM barco
                INNER JOIN socio ON socio.cedula = barco.socio_cedula
                ORDER BY barco.n_amarre;";
        $query = mysqli_query($conex, $sql);
        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}
