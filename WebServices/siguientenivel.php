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
    $Creacion = '2000-05-05';
   // Consulta para llamar al procedimiento almacenado según la acción y la paginación
   
   $completado = 0;
   $query = "CALL spGestionNivelesUsuarios('UP','$ID_usuario','$cursoID','$nivelID','$completado','$Creacion')";
  
   
    header('Content-Type: application/json');
    echo json_encode('hecho');
   
    

$conn->close();
?>