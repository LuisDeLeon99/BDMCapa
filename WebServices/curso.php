<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

//$json_data = file_get_contents('php://input');
//$data = json_decode($json_data, true);

if ($_POST) {
    
    
    //error_log('muestramelas ' . $_FILES);
    //error_log('muestramelas ' . $_POST);
   
    $ID_usuario = $_SESSION['ID_usuario'];
    $Niveles = $_POST['nivelesCurso'];
    $Gratis = $_POST['optionsRadios'];
    $Gratis = ($_POST['optionsRadios'] === 'true') ? true : false;

    $Titulo = $_POST['nombreCurso'];
    $Descripcion = $_POST['descripcionCurso']; 
    
    
    if ($Gratis) {
        $Costo = 0.00;
        $Gratis = 1;
    } else {
        $Costostr = floatval($_POST['precio']);
        $Costo = number_format($Costostr, 2, '.', '');
        $Gratis = 0;
    }
    
    // Obtener la imagen de presentación del curso
    $Imagen = $_FILES['imagenCurso']['name'];
    $ImagenTmp = $_FILES['imagenCurso']['tmp_name'];
    $ImagenContenido = addslashes(file_get_contents($ImagenTmp));
    //$imagen64 = base64_encode($ImagenContenido);
    
    // Obtener el diploma del curso
    $Diploma = $_FILES['diploma']['name'];
    $DiplomaTmp = $_FILES['diploma']['tmp_name'];
    $Diploma = addslashes(file_get_contents($DiplomaTmp));
    
    $accion = 'IN';
    $Eliminado = 0; // Valor predeterminado para la columna Eliminado
    $IDCat = $_POST['categoria'];
   
    $Creacion = '2000-05-05'; // Fecha actual
    $Inicio = 0;
    $Cantidad = 0;
    $idcur = 0;
    $prueb = '';


    $query = "CALL spGestionCursos('$accion','$idcur','$Niveles','$Costo','$Titulo','$Descripcion','$ImagenContenido','$Diploma','$Gratis','$Eliminado','$IDCat','$Creacion','$Inicio','$Cantidad','$ID_usuario')";
    $result = $conn->query($query);
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conn));
    } else {
        // Registro exitoso, redirigir a index.html
        //header("Location: ../index.html");
        exit();
    }
    // Perform the insertion into the database using the prepared statement
    //$insertQuery = "CALL spGestionCursos(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //$insertStmt = $conn->prepare($insertQuery);
    //$insertStmt->bind_param("ssisssbbiiisiii", $accion, $idcur, $Niveles, $Costo, $Titulo, $Descripcion, $ImagenData, $DiplomaData, $Gratis, $Eliminado, $IDCat, $Creacion, $Inicio, $Cantidad, $ID_usuario);
    //$insertResult = $insertStmt->execute();

    //if ($insertStmt->error) {
    //    $error_message = 'Error en la consulta: ' . $insertStmt->error;
    //    echo "<script>console.log('$error_message');</script>";
    //    error_log('Error en la consulta: ' . $insertStmt->error);
    //} else {
    //    echo 'Curso creado con éxito';
   // }
}



$conn->close();
?>