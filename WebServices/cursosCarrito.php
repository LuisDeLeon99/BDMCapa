<?php
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}


$query = "";

$query = "CALL spGestionCursos('SE1','1','5','100','titulo','descripcion','','','1','0','$categoria','2000-05-05','$inicio','$cursosPorPagina','2')";
                

// Ejecutar la consulta
$result = $conn->query($query);


if ($result->num_rows > 0) {
    // Array para almacenar los resultados
    $results_array = array();

    // Recorrer los resultados y guardarlos en el array
    while ($row = $result->fetch_assoc()) {
        $row["Imagen"] = base64_encode($row["Imagen"]);
        $results_array[] = $row;
        
        
    }
    
    // Devolver los resultados en formato JSON al front-end
    
    
    
} else {
    // No se encontraron resultados
    echo '{"error": "error"}';
}

header('Content-Type: application/json');
echo json_encode($results_array);

$conn->close();
?>