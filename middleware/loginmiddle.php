<?php

function verificarSesionMiddleware($next)
{
    // Verificar si hay una sesión iniciada
    if (!isset($_SESSION['usuario'])) {
        // No hay sesión, redirigir al usuario a la página de error o mostrar un mensaje de error
        header('Location: pagina_de_error.php');
        exit();
    }

    // Ejecutar el siguiente middleware o controlador
    return $next();
}
?>