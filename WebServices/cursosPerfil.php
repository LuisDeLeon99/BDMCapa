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
    $results_arrayb = array();
    $results_arrayc = array();
    $totalCosto = 0;
    $totalCostoDecimal = number_format($totalCosto, 2, '.', '');
    $ID_usuario = intval($_SESSION['ID_usuario']);
    $Creacion = '2000-05-05'; 
    if ($_SESSION['rol'] == 'Instructor'){
        $rol =  $_SESSION['rol'];
        $query = "CALL spGestionCursosUsuarios('SE','0','5','$ID_usuario','$totalCostoDecimal','','$Creacion','$Creacion')";
    
         // Ejecutar la consulta
         if ($conn->multi_query($query)) {
             do {
                 // Obtener el resultado actual
                 $result = $conn->store_result();
    
                 if ($result !== false && $result->num_rows > 0) {
                     // Recorrer los resultados y guardarlos en el array
                     while ($row = $result->fetch_assoc()) {
                         $row["ImagenCurso"] = base64_encode($row["ImagenCurso"]);
                         $row["procedencia"] = "0";
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
            
            if (empty($results_array[0])) {
                
                $query3 = "CALL spGestionCursos('SE8','0','0','$totalCostoDecimal','','','','','0','0','0','$Creacion','0','0','$ID_usuario')";
                    
                if ($conn->multi_query($query3)) {
                    do {
                        // Obtener el resultado actual
                        $result = $conn->store_result();
                        
                        if ($result !== false && $result->num_rows > 0) {
                            // Recorrer los resultados y guardarlos en el arreglo $results_array3
                            while ($row = $result->fetch_assoc()) {
                                $row["Imagen"] = base64_encode($row["Imagen"]);
                                $row["procedencia"] = "2";
                                $results_arrayc[] = $row;
                            }
                        }
                        
                        // Liberar los resultados
                        if ($result !== false) {
                            $result->free();
                        }
                        
                        // Avanzar al siguiente conjunto de resultados
                    } while ($conn->more_results() && $conn->next_result());
                    
                    // Salir del código PHP con la respuesta de la tercera consulta
                    if (!empty($results_arrayc[0])) {
                        $results_arrayc[0]["Rol"] = $rol;
                        header('Content-Type: application/json');
                        echo json_encode($results_arrayc);
                        exit();
                    } else {
                        // No se encontraron resultados en $results_array
                        header('Content-Type: application/json');
                        echo json_encode('Sin cursos');
                        exit();
                    }
                    
                }
            }
            $results_array[0]["Rol"] = $rol;

            // Ejecutar el segundo procedimiento almacenado
        $query2 = "CALL spGestionCursosUsuarios('SE2','0','5','$ID_usuario','$totalCostoDecimal','','$Creacion','$Creacion')";
    
        if ($conn->multi_query($query2)) {
            do {
                // Obtener el resultado actual
                $result = $conn->store_result();
        
                if ($result !== false && $result->num_rows > 0) {
                    // Recorrer los resultados y guardarlos en el arreglo $results_array2
                    while ($row = $result->fetch_assoc()) {
                        $row["procedencia"] = "1";
                        $results_arrayb[] = $row;
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
            if (!empty($results_arrayb)) {
                // Combinar los arreglos $results_array y $results_array2
                $combined_results = array_merge($results_array, $results_arrayb);

                // Devolver los resultados combinados en formato JSON al front-end
                header('Content-Type: application/json');
                echo json_encode($combined_results);
            } else {
                // No se encontraron resultados en $results_array2
                // Devolver los resultados de $results_array en formato JSON al front-end
                header('Content-Type: application/json');
                echo json_encode($results_array);
            }
        } else {
            // No se encontraron resultados en $results_array
            header('Content-Type: application/json');
            echo json_encode('Sin cursos');
        }

    }




    
    if ($_SESSION['rol'] == 'Alumno'){
        $rol =  $_SESSION['rol'];   
        $query = "CALL spGestionCursosUsuarios('SE3','0','$ID_usuario','0','$totalCostoDecimal','','$Creacion','$Creacion')";
   
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