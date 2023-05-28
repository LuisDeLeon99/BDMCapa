<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (isset($data['tituloCurso'])) {
    $ID_usuario = $_SESSION['ID_usuario'];
    $Niveles = $data['nivelesCurso'];
    $Gratis = $data['gratisCurso'];    
    $Titulo = $data['tituloCurso'];
    $Descripcion = $data['descripcionCurso'];
    $Imagen = $data['imagenCurso'];
    $Diploma = $data['diplomaCurso'];
    if ( $Gratis) {
        $Costo = 0;
    } else {
        $Costo = $data['costoCurso'];
    }

    $Eliminado = 0; // Valor predeterminado para la columna Eliminado
    $IDCat = $data['idCategoria'];
    $Creacion = date('Y-m-d'); // Fecha actual
    $Inicio = 0;
    $Cantidad = 0;

    // Perform the insertion into the database using the prepared statement
    $insertQuery = "CALL spGestionCursos('IN', 0, $Niveles, $Costo, '$Titulo', '$Descripcion', '$Imagen', '$Diploma', $Gratis, $Eliminado, $IDCat, '$Creacion', $Inicio, $Cantidad)";
    $insertResult = $conn->query($insertQuery);

    if ($insertResult) {
        echo 'Curso creado con éxito';
    } else {
        echo 'Error al crear el curso';
    }
}



$conn->close();
?>