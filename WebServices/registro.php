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
    
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $fechaNac = $_POST['Fecha_N'];
    // $usuario = $_POST['usuario']
    $contraseña = $_POST['contrasenia'];
    $confcontra = $_POST['confcontra'];
    $imagen = $_POST['image'];
    }

    $query = "CALL spGestionUsuarios('IN','1','$nombre','$apellidos','$apellidos','$contraseña','1','$imagen','1','$correo','$fechaNac','$fechaNac','0')";
$result = mysqli_query($conn, $query);

// Verificar si la consulta se ejecutó correctamente
if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($conn));
}

// Recibir los datos de regreso
// while ($row = mysqli_fetch_assoc($result)) {
//     // Hacer algo con los datos
//     echo $row['campo'];
// }

// Cerrar la conexión
mysqli_close($conn);

?>