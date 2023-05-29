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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID_usuario = $_SESSION['ID_usuario'];
    $Niveles = $_POST['nivelesCurso'];
    $Gratis = $_POST['optionsRadios'];    
    $Titulo = $_POST['nombreCurso'];
    $Descripcion = $_POST['descripcionCurso'];   
    if ($Gratis) {
        $Costo = 0;
    } else {
        $Costo = $_POST['precio'];
    }
    $imagenCursoData = file_get_contents($_FILES['imagenCurso']['tmp_name']);
    $diplomaData = file_get_contents($_FILES['diploma']['tmp_name']);
    $accion = 'IN';
    $Eliminado = 0; // Valor predeterminado para la columna Eliminado
    $IDCat = $_POST['categoria'];
    $IDCat = 1;
    $Creacion = '2000-05-05'; // Fecha actual
    $Inicio = 0;
    $Cantidad = 0;
    $idcur = 0;

    // Perform the insertion into the database using the prepared statement
    $insertQuery = "CALL spGestionCursos(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ssisssbbiissiii", $accion, $idcur, $Niveles, $Costo, $Titulo, $Descripcion, $imagenCursoData, $diplomaData, $Gratis, $Eliminado, $IDCat, $Creacion, $Inicio, $Cantidad, $ID_usuario);
    $insertResult = $insertStmt->execute();

    if ($insertStmt->error) {
        echo 'Error en la consulta: ' . $insertStmt->error;
    } else {
        echo 'Curso creado con éxito';
    }
}



$conn->close();
?>