<?php
/* require_once 'conexion.php'; */
session_start();

// Obtener los valores del formulario de inicio de sesión
if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    //dummy
    if ($usuario == 'user' && $pass == 'pass') {
        
        
        $usel = 'usuario';
        $err = 0;

        if ($err >= 3) {
            // Cuenta bloqueada
            
        } else {
            // Inicio de sesión exitoso
         
            
            // Guardar usuario y rol en la sesión
            $_SESSION['usuario'] = $usuario;
            
           
                $_SESSION['rol'] = 'Comprador';
            
                $_SESSION['privacidad'] = 'Publico';
            $_SESSION['nombre'] = 'Roberto';
            $_SESSION['Apaterno'] = 'Ruiz';
            $_SESSION['Amaterno'] = 'Ochoa';
            $_SESSION['imagen'] = 0;
            $_SESSION['ID_usuario'] = 1;
            
                $_SESSION['genero'] = 'Masculino';
           
            
            $_SESSION['fecha'] = '05-09-2023';
            $_SESSION['fechan'] = '09-11-1999';
            $_SESSION['correo'] = 'correo';
            header("Location: ../pages/inicio.html");
            exit();
        }
    } else {
        // Inicio de sesión fallido
        
       // Credenciales inválidas
       echo '<script>alert("Credenciales inválidas");</script>';
       // Redirige a la página de inicio después de unos segundos
       echo '<script>window.setTimeout(function(){ window.location.href = "../index.html"; }, 3000);</script>';
        exit();
    }

}
    // Llamar al procedimiento almacenado spLogin
   /*  $sql = "CALL spLogin('$usuario', '$pass')";
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
            $_SESSION['ID_usuario'] = $row['ID_usuario'];
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
$conn->close(); */
?>