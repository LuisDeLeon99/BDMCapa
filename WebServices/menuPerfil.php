<?php
session_start();
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 'Alumno') {
        echo '<a href="cursosAgregados.html" class="btn btn-primary">Mis cursos inscritos</a>';
    } elseif ($_SESSION['rol'] == 'Instructor') {
        echo '<a href="cursosAgregados.html" class="btn btn-primary">Mis cursos agregados</a>';
    }    
}
?>
