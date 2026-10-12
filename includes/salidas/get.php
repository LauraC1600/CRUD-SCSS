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

function obtener_salidas()
{
    try {
        $conex = obtener_conexion();
        // INNER JOIN trae el nombre del barco; ORDER BY muestra primero las mas recientes
        $sql = "SELECT salidas.IdSalida, salidas.Fecha, salidas.Hora, salidas.Destino,
                       salidas.Barcos_Matricula AS Matricula, barco.nombre AS barco_nombre
                FROM salidas
                INNER JOIN barco ON barco.matricula = salidas.Barcos_Matricula
                ORDER BY salidas.Fecha DESC, salidas.Hora DESC;";
        $query = mysqli_query($conex, $sql);
        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}
