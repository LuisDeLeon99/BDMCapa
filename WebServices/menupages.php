<?php
session_start();
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol']== 'Vendedor'){
    echo '
    <li class="nav-item">
        <a class="nav-link" href="carrito.html">Carrito</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="Perfil.html">Cuenta</a>
    </li>
    <li class="nav-item">    
        <a class="nav-link" href="Perfil.html">Ventas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../WebServices/logout.php">Cerrar sesión</a>
    </li>';
    }
    if ($_SESSION['rol']== 'Comprador'){
        echo '
        <li class="nav-item">
            <a class="nav-link" href="carrito.html">Carrito</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="Perfil.html">Cuenta</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="Perfil.html">Listas</a>
    </li>
        <li class="nav-item">    
            <a class="nav-link" href="cursosAgregados.html">Compras</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../WebServices/logout.php">Cerrar sesión</a>
        </li>';
        }
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