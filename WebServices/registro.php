<?php
include 'validacion.php';
/* require_once 'conexion.php'; */

$valida = 0;
$usuarioExistente = 0;

// dummy
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

    
     
        if ($valida) {
           
                // Registro exitoso, redirigir a index.html
                header("Location: ../index.html");
                exit();
            
        }
    else
    {
        echo "Error al crear el usuario. Por favor, inténtalo de nuevo más tarde.";
        exit();
    }
    



/* if($_POST){
    
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

    $query = "CALL spVerificarUsuario('$usuario', @usuarioExistente)";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conn));
    }

    $query = "SELECT @usuarioExistente";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result);
    $usuarioExistente = $row[0];
   
    if ($usuarioExistente > 0) {
        echo "El usuario ya existe. Por favor, elige otro nombre de usuario.";
    } else {
        if ($valida) {
            $query = "CALL spGestionUsuarios('IN','1','$usuario','$nombre','$apellidop','$apellidom','$contraseña','$rol','$imgContent','$genero','$correo','$fechaNac','$fechaNac','0','0')";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Error al ejecutar la consulta: " . mysqli_error($conn));
            } else {
                // Registro exitoso, redirigir a index.html
                header("Location: ../index.html");
                exit();
            }
        }
    }

// Verificar si la consulta se ejecutó correctamente


// Recibir los datos de regreso
// while ($row = mysqli_fetch_assoc($result)) {
//     // Hacer algo con los datos
//     echo $row['campo'];
// }

// Cerrar la conexión
mysqli_close($conn); */
?>