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
if (isset($_POST['calificacion'])) {
    $calificacion = $_POST['calificacion'];
    $cursoID = intval($_POST['cursoId']);
    $ID_usuario = intval($_SESSION['ID_usuario']);
    $totalCostoDecimal = number_format($calificacion, 2, '.', '');
    $totalCostoDecimal = $totalCostoDecimal * 20;
    $Creacion = '2000-05-05'; 
   // Consulta para llamar al procedimiento almacenado según la acción y la paginación
  
   $completado = 0;
   $query =  "CALL spGestionCursosUsuarios('UP2', '$cursoID', '$ID_usuario', '$ID_usuario', '$totalCostoDecimal', '','$Creacion','$Creacion')";
   $result = $conn->query($query);
   
   if ($result && mysqli_affected_rows($conn) > 0) {
    // La primera consulta se ejecutó correctamente y se actualizó la calificación

    // Realizar la segunda consulta para obtener el curso con la calificación actualizada
    $query2 = "CALL spGestionCursosUsuarios('SE6','$cursoID','$ID_usuario','$ID_usuario','$totalCostoDecimal','','$Creacion','$Creacion')";
    $result2 = $conn->query($query2);

    if ($result2 && $result2->num_rows > 0) {
        // La segunda consulta se ejecutó correctamente y se encontraron resultados

        // Obtener el curso y la calificación actualizada
        $row = $result2->fetch_assoc();
        $curso = $row['Curso'];
        $calificacionActualizada = $row['Calificacion'];

        // Construir la respuesta
        $response = array(
            'curso' => $curso,
            'calificacion' => $calificacionActualizada
        );

        // Establecer el código de respuesta HTTP como 200 (OK)
        http_response_code(200);
        // Establecer el encabezado de respuesta como JSON
        header('Content-Type: application/json');
        // Devolver la respuesta JSON
        echo json_encode($response);
        exit();
    } else {
        // La segunda consulta no se ejecutó correctamente o no se encontraron resultados
        $error = array(
            'error' => true,
            'message' => 'Error al obtener el curso con la calificación actualizada'
        );
        http_response_code(500); // Establecer el código de respuesta HTTP como 500 (Error interno del servidor)
        echo json_encode($error);
        exit();
    }
    } else {
        // La primera consulta no se ejecutó correctamente o no se actualizó la calificación
        $error = array(
            'error' => true,
            'message' => 'Error al actualizar la calificación del curso'
        );
        http_response_code(500); // Establecer el código de respuesta HTTP como 500 (Error interno del servidor)
        echo json_encode($error);
        exit();
    }

   
    
}
$conn->close();
?>