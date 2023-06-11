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
       $row["procedencia"] = "0";
       $cursoRow = $row;   
       // Devolver la fila en formato JSON al front-end
    //     header('Content-Type: application/json');
    //    echo json_encode($row); 
       
   } else {
       // No se encontró una fila o se encontraron múltiples filas
       echo '{"error": "error"}';
   }
   $result->free();
   $conn->next_result();
   $results_array = array();
   $completado = 0;
   $query2 = "CALL spGestionNiveles('SE2','0','$cursoID','1','','t','d','$completado')";
   array_push($results_array, $cursoRow);
    if ($conn->multi_query($query2)) {
        do {
            // Obtener el resultado actual
            $result = $conn->store_result();
    
            if ($result !== false && $result->num_rows > 0) {
                // Recorrer los resultados y guardarlos en el arreglo $results_array2
                while ($row = $result->fetch_assoc()) {
                    $row["procedencia"] = "1";
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

   if (!empty($results_array)) {
       if (!empty($cursoRow)) {
           // Combinar los arreglos $results_array y $results_array2
           
           
           // Devolver los resultados combinados en formato JSON al front-end
           header('Content-Type: application/json');
           echo json_encode($results_array);
       } else {
           // No se encontraron resultados en $results_array2
           // Devolver los resultados de $results_array en formato JSON al front-end
           header('Content-Type: application/json');
           echo json_encode($results_array);
       }
   } else {
       // No se encontraron resultados en $results_array
       echo '{"error": "error"}';
   }
    

$conn->close();
?>