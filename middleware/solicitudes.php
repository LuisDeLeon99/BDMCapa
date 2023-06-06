<?php

function logRequestMiddleware($next)
{
    // Obtener información de la solicitud
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $_SERVER['REQUEST_URI'];
    $timestamp = date('Y-m-d H:i:s');

    // Registrar la solicitud en un archivo de registro o en una base de datos
    $logMessage = "Solicitud recibida - IP: $ip, URL: $url, Fecha: $timestamp";
    file_put_contents('log.txt', $logMessage . PHP_EOL, FILE_APPEND);

    // Ejecutar el siguiente middleware o controlador
    return $next();
}
?>