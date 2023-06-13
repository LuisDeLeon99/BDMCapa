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
    $ID_usuario = intval($_SESSION['ID_usuario']);
    $cursoID = isset($_POST['cursoId']) ? intval($_POST['cursoId']) : 0;
    $nivelID = isset($_POST['nivelId']) ? intval($_POST['nivelId']) : 0;
    $nivel = isset($_POST['nivel']) ? intval($_POST['nivel']) : 0;
    $Creacion = '2000-05-05';
    $totalCosto = 0;
    $totalCostoDecimal = number_format($totalCosto, 2, '.', '');
   // Consulta para llamar al procedimiento almacenado según la acción y la paginación
   
   $completado = 0;
   $query = "CALL spGestionNivelesUsuarios('UP','$ID_usuario','$cursoID','$nivelID','$completado','$Creacion')";
   $result = $conn->query($query);
   
   $query2 = "CALL spGestionCursosUsuarios('SE5','$cursoID','$ID_usuario','1','$totalCostoDecimal','','$Creacion','$Creacion')";
   $result2 = $conn->query($query2);
    $row2 = $result2->fetch_assoc(); // Obtener la fila de resultados

    $avance = $row2['NivelAvance'];
    $maxniv = $row2['NumeroNiveles']; // Obtener el valor de NivelAvance

    $nivelID++; // Incrementar nivelId
    $nivel++;
    $response = array(
        'cursoId' => $cursoID,
        'nivelId' => $nivelID,
        'progreso' => $avance,
        'nivelmax' => $maxniv,
        'nivel' => $nivel
    );
    header('Content-Type: application/json');
    echo json_encode($response);
   
    

$conn->close();
?>