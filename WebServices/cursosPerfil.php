<?php
require_once 'conexion.php';
session_start(); 
if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

if (isset($_SESSION['rol'])) {
    
    
    // Array para almacenar los resultados
    $results_array = array();
    $totalCosto = 0;
    $ID_usuario = $_SESSION['ID_usuario'];
 
    if ($_SESSION['rol'] == 'Instructor'){
        $rol =  $_SESSION['rol'];
         $query = "CALL spGestionCursos('SE6','0','5','100','titulo','descripcion','','','1','0','0','2000-05-05','0','0',' $ID_usuario')";
    
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
    
            $results_array[0]["Rol"] = $rol;

        if (!empty($results_array)) {
            // Devolver los resultados en formato JSON al front-end
            header('Content-Type: application/json');
            echo json_encode($results_array);
        } else {
            // No se encontraron resultados
            echo '{"error": "error"}';
        }

    }

    if ($_SESSION['rol'] == 'Alumno'){
            
        $query = "CALL spGestionCursos('SE6','0','5','100','titulo','descripcion','','','1','0','0','2000-05-05','0','0',' $ID_usuario')";
   
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
           $results_array[0]["Rol"] = $rol;
           

       if (!empty($results_array)) {
           // Devolver los resultados en formato JSON al front-end
           header('Content-Type: application/json');
           echo json_encode($results_array);
       } else {
           // No se encontraron resultados
           echo '{"error": "error"}';
       }

   }

} else {
    // No se encontró el carrito en la sesión
    echo '{"error": "No se encontró el carrito en la sesión."}';
}



$conn->close();
?>