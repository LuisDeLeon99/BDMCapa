<?php
require_once 'conexion.php';
session_start(); 
if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}
if (isset($_SERVER['HTTP_CURSOID'])) {
    $idCurso = $_SERVER['HTTP_CURSOID'];
    // Resto de tu código aquí...
}
    
    // Array para almacenar los resultados
    $results_array = array();
   
    $totalCosto = 0;
    $totalCostoDecimal = number_format($totalCosto, 2, '.', '');
    $ID_usuario = intval($_SESSION['ID_usuario']);
    $Creacion = '2000-05-05'; 
   
        

            // Ejecutar el segundo procedimiento almacenado
        $query2 = "CALL spGestionCursosUsuarios('SE4','$idCurso','5','$ID_usuario','$totalCostoDecimal','','$Creacion','$Creacion')";
    
        if ($conn->multi_query($query2)) {
            do {
                // Obtener el resultado actual
                $result = $conn->store_result();
        
                if ($result !== false && $result->num_rows > 0) {
                    // Recorrer los resultados y guardarlos en el arreglo $results_array2
                    while ($row = $result->fetch_assoc()) {
                        
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
           
                header('Content-Type: application/json');
                echo json_encode($results_array);
           
        } else {
            // No se encontraron resultados en $results_array
            header('Content-Type: application/json');
            echo json_encode('Sin cursos');
        }

    




    
   
$conn->close();
?>