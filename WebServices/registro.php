<?php
include 'validacion.php';
$servername = "localhost";
$username = "root";
$password = "miau123";
$dbname = "bdm";
$valida = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if($_POST){
    
    $nombre = $_POST['nombre'];
    $apellidop = $_POST['apellidopat'];
    $apellidom = $_POST['apellidomat'];
    $correo = $_POST['correo'];
    $fechaNac = $_POST['Fecha_N'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contrasenia'];
    $valida = validarContrasena($contraseña);
    $confcontra = $_POST['confcontra'];
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }
    else $imgContent = 1;
    $genero = $_POST['genero'];
    $genero = intval($genero);
    $rol = $_POST['rol'];
    $rol = intval($rol);
    }


if ($valida) {$query = "CALL spGestionUsuarios('IN','1','$usuario','$nombre','$apellidop','$apellidom','$contraseña','$rol','$imgContent','$genero','$correo','$fechaNac','$fechaNac','0')";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($conn));
}
}

// Verificar si la consulta se ejecutó correctamente


// Recibir los datos de regreso
// while ($row = mysqli_fetch_assoc($result)) {
//     // Hacer algo con los datos
//     echo $row['campo'];
// }

// Cerrar la conexión
mysqli_close($conn);

?>