<?php
require_once 'conexion.php';

// Obtener los valores del formulario de inicio de sesión
if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    // Llamar al procedimiento almacenado spLogin
    $sql = "CALL spLogin('$usuario', '$pass')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rol = $row['Rol'];
        $usel = $row['usel'];
        $err = $row['err'];

        if ($err == 3) {
            // Cuenta bloqueada
            echo "Tu cuenta está bloqueada. Por favor, ponte en contacto con el administrador.";
        } else {
            // Inicio de sesión exitoso
            // Realizar acciones adicionales según el rol o usel
            // ...

            echo "Inicio de sesión exitoso. Rol: $rol, usel: $usel";
        }
    } else {
        // Inicio de sesión fallido
        echo "Inicio de sesión fallido. Usuario o contraseña incorrectos.";
    }
}

mysqli_close($conn);
?>