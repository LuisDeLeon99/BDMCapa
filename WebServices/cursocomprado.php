<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    $response = array(
        'error' => true,
        'message' => 'No hay sesión iniciada',
        'redirect_url' => 'http://localhost:3005/BDMCapa/pages/Nologin.html' // Cambia 'ruta-de-tu-página-de-redirección.html' con la URL de la página a la que deseas redirigir
    );

    http_response_code(200); // Establecer el código de respuesta HTTP como 200 (OK)
    header('Content-Type: application/json'); // Establecer el encabezado de respuesta como JSON
    echo json_encode($response); // Devolver la respuesta JSON     
    exit();
}

if ($_SESSION['rol'] !== 'Alumno') {
    // El usuario no tiene el rol adecuado para hacer la consulta
    $response = array(
        'error' => true,
        'message' => 'Acceso denegado, solo usuarios Alumnos'
    );

    http_response_code(403); // Establecer el código de respuesta HTTP como 403 (Acceso denegado)
    header('Content-Type: application/json'); // Establecer el encabezado de respuesta como JSON
    echo json_encode($response); // Devolver la respuesta JSON
    exit();
}

if (!isset($_POST['cursoId'])) {
    $response = array(
        'error' => true,
        'message' => 'Falta el parámetro cursoId'
    );

    http_response_code(400); // Establecer el código de respuesta HTTP como 400 (Solicitud incorrecta)
    header('Content-Type: application/json'); // Establecer el encabezado de respuesta como JSON
    echo json_encode($response); // Devolver la respuesta JSON
    exit();
}

$cursoID = intval($_POST['cursoId']);
$ID_usuario = intval($_SESSION['ID_usuario']);

// Consulta para llamar al procedimiento almacenado según la acción y la paginación
$query = "CALL spGestionCursos('SE7', '$cursoID', 5, 100, 'titulo', 'descripcion', '', '', 1, 0, 1, '2000-05-05', 1, 1, '$ID_usuario')";

// Ejecutar la consulta
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // El usuario tiene el curso comprado
    $response = array(
        'comprado' => true
    );
} else {
    // El usuario no tiene el curso comprado
    $response = array(
        'comprado' => false
    );
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);


$conn->close();
?>
    