<?php
require_once 'conexion.php';
session_start(); 
if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
    
    // Array para almacenar los resultados
    $results_array = array();

    foreach ($carrito as $item) {
        if (isset($item['cursoID'])) {
            $cursoID = $item['cursoID'];
            
            $query = "CALL spGestionCursos('SE5','$cursoID','5','100','titulo','descripcion','','','1','0','0','2000-05-05','0','0','2')";

            // Ejecutar la consulta
            if ($conn->multi_query($query)) {
                do {
                    // Obtener el resultado actual
                    $result = $conn->store_result();

                    if ($result !== false && $result->num_rows > 0) {
                        // Recorrer los resultados y guardarlos en el array
                        while ($row = $result->fetch_assoc()) {
                            $row["Imagen"] = base64_encode($row["Imagen"]);
                            $results_array[] = $row;
                        }
                    }

                    // Liberar los resultados
                    if ($result !== false) {
                        $result->free();
                    }

                    // Avanzar al siguiente conjunto de resultados
                } while ($conn->more_results() && $conn->next_result());
            }
        }
    }

    if (!empty($results_array)) {
        // Devolver los resultados en formato JSON al front-end
        header('Content-Type: application/json');
        echo json_encode($results_array);
    } else {
        // No se encontraron resultados
        echo '{"error": "error"}';
    }
} else {
    // No se encontró el carrito en la sesión
    echo '{"error": "No se encontró el carrito en la sesión."}';
}

$conn->close();
?>