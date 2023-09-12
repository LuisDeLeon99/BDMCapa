<?php
session_start();
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 'Comprador') {
        echo '<a href="cursosAgregados.html" class="btn btn-primary">Mis Listas</a>';
    } elseif ($_SESSION['rol'] == 'Vendedor') {
        echo '<a href="cursosAgregados.html" class="btn btn-primary">Mis cursos agregados</a>';
    }    
}
?>
