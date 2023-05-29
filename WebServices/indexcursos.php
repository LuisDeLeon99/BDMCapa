<?php
// Archivo: obtener_cursos.php

require_once 'conexion.php';

// Parámetros de entrada
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'SE1';
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$categoria = isset($_GET['categoria']) ? $_GET['pagina'] : 1;

// Cálculo de la posición de inicio para la paginación
$cursosPorPagina = 12;
$inicio = ($pagina - 1) * $cursosPorPagina;

// Consulta para llamar al procedimiento almacenado según la acción y la paginación
$consulta = "";

if ($accion === 'SE1') {
    $consulta = "CALL spGestionCursos('SE1', 0, 0, 0, '', '', 0, 0, 0, 0, $categoria, '2000-05-05', $inicio, $cursosPorPagina, 0)";
} elseif ($accion === 'SE2') {
    $consulta = "CALL spGestionCursos('SE2', 0, 0, 0, '', '', 0, 0, 0, 0, $categoria, '2000-05-05', $inicio, $cursosPorPagina, 0)";
} elseif ($accion === 'SE3') {
    $consulta = "CALL spGestionCursos('SE3', 0, 0, 0, '', '', 0, 0, 0, 0, $categoria, '2000-05-05', $inicio, $cursosPorPagina, 0)";
} else {
    // Acción no válida
    return null;
}


// Ejecutar la consulta
$resultado = mysqli_query($conn, $consulta);
$cursos = array();
if ($resultado && mysqli_num_rows($resultado) > 0){
    while ($row = $resultado->fetch_assoc()) {
        $cursos[] = $row;
    }
    $cursos_json = json_encode($cursos);
    echo $cursos_json;
}

mysqli_free_result($resultado);
$conn->close();
?>
