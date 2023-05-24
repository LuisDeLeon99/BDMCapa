<?php
require_once 'conexion.php';
session_start();

// Obtener los valores del formulario de inicio de sesión
if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    
    // Llamar al procedimiento almacenado spLogin
    $sql = "CALL spLogin('$usuario', '$pass')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $usel = $row['usel'];
        $err = $row['err'];

        if ($err >= 3) {
            // Cuenta bloqueada
            
        } else {
            // Inicio de sesión exitoso
            $rol = $row['Rol'];
            $genero = $row['Genero'];
            
            // Guardar usuario y rol en la sesión
            $_SESSION['usuario'] = $usuario;
            
            if ($rol == 0) {
                $_SESSION['rol'] = 'Admin';
            } elseif ($rol == 1) {
                $_SESSION['rol'] = 'Alumno';
            } elseif ($rol == 2) {
                $_SESSION['rol'] = 'Instructor';
            }
            
            $_SESSION['nombre'] = $row['Nombre'];
            $_SESSION['Apaterno'] = $row['Apaterno'];
            $_SESSION['Amaterno'] = $row['Amaterno'];
            $_SESSION['imagen'] = $row['Imagen'];
            
            if ($genero == 0) {
                $_SESSION['genero'] = 'Masculino';
            } elseif ($genero == 1) {
                $_SESSION['genero'] = 'Femenino';
            }
            
            $_SESSION['fecha'] = $row['Fecha'];
            $_SESSION['fechan'] = $row['Fechan'];
            $_SESSION['correo'] = $row['Correo'];
            header("Location: ../index.html");
            exit();
        }
    } else {
        // Inicio de sesión fallido
        header("Location: ../index.html");
        exit();
    }
}
mysqli_close($conn);
?>
    