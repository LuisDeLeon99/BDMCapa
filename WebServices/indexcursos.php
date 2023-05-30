<?php
require_once 'conexion.php';

// Parámetros de entrada
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'SE1';
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 1;

// Cálculo de la posición de inicio para la paginación

$cursosPorPagina = 8;
$inicio = ($pagina - 1) * $cursosPorPagina;

// Consulta para llamar al procedimiento almacenado según la acción y la paginación
$query = "";




if ($accion === 'SE1') {
    
    $query = "CALL spGestionCursos('SE1','1','5','100','titulo','descripcion','','','1','0','$categoria','2000-05-05','$inicio','$cursosPorPagina','2')";
                
} elseif ($accion === 'SE2') {
    $query = "CALL spGestionCursos('SE2','1','5','100','titulo','descripcion','','','1','0','$categoria','2000-05-05','$inicio','$cursosPorPagina','2')";
} elseif ($accion === 'SE3') {
    $query = "CALL spGestionCursos('SE3','1','5','100','titulo','descripcion','','','1','0','$categoria','2000-05-05','$inicio','$cursosPorPagina','2')";
} else {
    // Acción no válida
   
}


// Ejecutar la consulta
$result = $conn->query($query);
//$cursos = array();
//if ($result && mysqli_num_rows($result) > 0){
//    while ($row = mysqli_fetch_assoc($result)) {
//        $cursos[] = $row;
//    }
//    $cursos_json = json_encode($cursos);
//    header('Content-Type: application/json');
//    echo $cursos_json;
//}

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