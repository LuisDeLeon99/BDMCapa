<?php

session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}


if ($_POST) {
       
    $ID_usuario = $_SESSION['ID_usuario'];
    $Niveles = intval($_POST['niveles']);
    $idcur = intval($_POST['curso']);
    $max = intval($_POST['max']);
    $Titulo = $_POST['nombreNivel'];
    $Descripcion = $_POST['descripcionNivel']; 
    
        
    // Obtener el video de presentación del curso
    $Video = $_FILES['videoCurso']['name'];
    $VideoTmp = $_FILES['videoCurso']['tmp_name'];
    $VideoContenido = addslashes(file_get_contents($VideoTmp));
    $completado = 0;
    $id = 0;
    $accion = 'UP';
    //echo var_dump($_POST);
    //echo var_dump($_FILES);
   
    $query = "CALL spGestionNiveles('$accion','$id','$idcur','$Niveles','$VideoContenido','$Titulo','$Descripcion','$completado')";
    $result = $conn->query($query);
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conn));
    } else {
        // Registro exitoso, redirigir a index.html
        if ($max == $Niveles) {
            
            header("Location: ../index.html");
            exit();                      
        }
        if ($max > $Niveles) {
        $Niveles = intval($Niveles) + 1;
        header("Location: ../pages/cargarNiveles.html?3K32:Da=" . urlencode($max) . "&or3Zfl4w=" . urlencode($idcur) . "&cantidad=" . urlencode($Niveles));
        exit();
        }
        
    }
   
}



$conn->close();
?>