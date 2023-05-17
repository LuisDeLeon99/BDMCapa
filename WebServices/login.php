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
            echo "Tu cuenta está bloqueada. Por favor, ponte en contacto con el administrador.";
        } else{
            // Inicio de sesión exitoso
            $rol = $row['Rol'];

            // Guardar usuario y rol en la sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $rol;                       
            header("Location: ../index.html");
            exit();
        }
    } else {
        // Inicio de sesión fallido
        echo "Inicio de sesión fallido. Usuario o contraseña incorrectos.";
    }
}

mysqli_close($conn);
?>