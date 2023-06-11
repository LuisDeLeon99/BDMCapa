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
    
    $cursoID = isset($_GET['cursoId']) ? intval($_GET['cursoId']) : 0;
    $nivelID = isset($_GET['nivelId']) ? intval($_GET['nivelId']) : 0;
      
   // Consulta para llamar al procedimiento almacenado según la acción y la paginación
   
   $completado = 0;
   $query = "CALL spGestionNiveles('SE3','$nivelID','$cursoID','1','','t','d','$completado')";
   $result = $conn->query($query);
   if ($result && $result->num_rows == 1) {
    // Obtener la fila única
    $row = $result->fetch_assoc();
    
    // Modificar la fila según sea necesario
    $row["Video"] = base64_encode($row["Video"]);
    
    // Devolver la fila en formato JSON al front-end
    
    }

   if (!empty($row)) {
    header('Content-Type: application/json');
    echo json_encode($row);
   } else {
       // No se encontraron resultados en $results_array
       echo '{"error": "error"}';
   }
    

$conn->close();
?>