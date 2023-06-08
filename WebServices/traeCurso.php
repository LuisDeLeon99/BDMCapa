<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

    
    $cursoID = $_GET['cursoId'];
    
    
    
    // Consulta para llamar al procedimiento almacenado según la acción y la paginación
    $query = "CALL spGestionCursos('SE','$cursoID','5','100','titulo','descripcion','','','1','0','1','2000-05-05','1','1','2')";

    // Ejecutar la consulta
    $result = $conn->query($query);

    if ($result && $result->num_rows == 1) {
        // Obtener la fila única
        $row = $result->fetch_assoc();
        
        // Modificar la fila según sea necesario
        $row["Imagen"] = base64_encode($row["Imagen"]);
        
            
        // Devolver la fila en formato JSON al front-end
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // No se encontró una fila o se encontraron múltiples filas
        echo '{"error": "error"}';
    }

$conn->close();
?>