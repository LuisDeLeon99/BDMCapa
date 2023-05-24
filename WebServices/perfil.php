<?php
session_start(); // Debe colocarse al inicio del archivo PHP

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    
    exit();
}

// Imprimir el contenido de $_SESSION (opcional para depuración)


$data = array(
    'rol' => $_SESSION['rol'],
    'fecha_creacion' => $_SESSION['fecha'],
    'fecha_nacimiento' => $_SESSION['fechan'],
    'genero' => $_SESSION['genero'],
    'usuario' => $_SESSION['usuario'],
    'nombre' => $_SESSION['nombre'],
    'apaterno' => $_SESSION['Apaterno'],
    'amaterno' => $_SESSION['Amaterno'],
    'correo' => $_SESSION['correo'],
    
    // Agrega más datos aquí
);

header('Content-Type: application/json');
echo json_encode($data);
?>