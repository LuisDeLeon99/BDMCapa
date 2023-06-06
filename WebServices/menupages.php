<?php
session_start();
if (isset($_SESSION['usuario'])) {
    echo '
    <li class="nav-item">
        <a class="nav-link" href="carrito.html">Carrito</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="Perfil.html">Cuenta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../WebServices/logout.php">Cerrar sesión</a>
    </li>';
} else {
    echo '
    <li class="nav-item">
        <a class="nav-link" href="Login.html">Inicia sesión</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="Registro.html">Crear cuenta</a>
    </li>';
}
?>