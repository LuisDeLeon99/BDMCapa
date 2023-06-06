<?php
session_start();
if (isset($_SESSION['usuario'])) {
    echo '
    <li class="nav-item">
        <a class="nav-link" href="pages/carrito.html">Carrito</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="pages/Perfil.html">Cuenta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="WebServices/logout.php">Cerrar sesión</a>
    </li>';
} else {
    echo '
    <li class="nav-item">
        <a class="nav-link" href="pages/Login.html">Inicia sesión</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="pages/Registro.html">Crear cuenta</a>
    </li>';
}
?>
