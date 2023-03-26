<?php
$servername = "localhost";
$username = "root";
$password = "miau123";
$dbname = "bdm";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
if($_POST){
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
echo 'prueba', $usuario;
}
?>