<?php
// Archivo: obtener_cursos.php

require_once 'conexion.php';

// Parámetros de entrada
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'SE1';
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Cálculo de la posición de inicio para la paginación
$cursosPorPagina = 12;
$inicio = ($pagina - 1) * $cursosPorPagina;

// Consulta para llamar al procedimiento almacenado según la acción y la paginación
$consulta = "";

if ($accion === 'SE1') {
    $consulta = "CALL spGestionCursos('SE1', 0, 0, 0, '', '', 0, 0, 0, 0, 0, '2000-05-05', $inicio, $cursosPorPagina, 0)";
} elseif ($accion === 'SE2') {
    $consulta = "CALL spGestionCursos('SE2', 0, 0, 0, '', '', 0, 0, 0, 0, 0, '2000-05-05', $inicio, $cursosPorPagina, 0)";
} elseif ($accion === 'SE3') {
    $consulta = "CALL spGestionCursos('SE3', 0, 0, 0, '', '', 0, 0, 0, 0, 0, '2000-05-05', $inicio, $cursosPorPagina, 0)";
} else {
    // Acción no válida
    return null;
}

// Ejecutar la consulta
$resultado = mysqli_query($conn, $consulta);
$respuestahtml = "";
// Verificar si se obtuvieron resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Recorrer los resultados y mostrar los cursos
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $idCurso = $fila['ID_curso'];
        $titulo = $fila['Titulo'];
        $calificacion = $fila['CalificacionPromedio'];

        // Mostrar el curso en el HTML
        $respuestahtml.=' <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center text-dark">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Cursos populares</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div class="text-dark text-decoration-line-through">
                                <!-- Product price-->
                                $40.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a style="color:black" class="btn btn-outline-info mt-auto"
                                href="#">Agregar al carrito</a></div>
                        </div>
                    </div>
                </div>';
        
        
        echo "<div>";
        echo "<h3>ID: $idCurso</h3>";
        echo "<p>Título: $titulo</p>";
        echo "<p>Calificación: $calificacion</p>";
        echo "</div>";
    }
} else {
    echo "No se encontraron cursos.";
}

// Liberar los recursos y cerrar la conexión
mysqli_free_result($resultado);
$conn->close();
?>
