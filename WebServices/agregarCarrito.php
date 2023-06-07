<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

if (isset($_POST['cursoID'])) {
    $cursoID = $_POST['cursoID'];

    // Verificar si el array "carrito" existe en la sesión
    if (!isset($_SESSION['carrito'])) {
        // Si no existe, crear un nuevo array "carrito" en la sesión
        $_SESSION['carrito'] = array();
    }

    // Verificar si el curso ya existe en el carrito
    $cursoExistente = false;
    foreach ($_SESSION['carrito'] as $curso) {
        if ($curso['cursoID'] == $cursoID) {
            $cursoExistente = true;
            break;
        }
    }

    if (!$cursoExistente) {
        // El curso no existe en el carrito, agregarlo
        $nuevoCurso = array(
            'cursoID' => $cursoID,
        );
        $_SESSION['carrito'][] = $nuevoCurso;

        // Respuesta de éxito
        $response = array(
            'status' => 'success',
            'message' => 'Curso agregado al carrito correctamente.',
            'curso' => $nuevoCurso
        );
    } else {
        // El curso ya existe en el carrito, enviar mensaje de error
        $response = array(
            'status' => 'error',
            'message' => 'El curso ya existe en el carrito.'
        );
    }
} else {
    // No se recibió la ID del curso
    $response = array(
        'status' => 'error',
        'message' => 'No se recibió la ID del curso.'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>