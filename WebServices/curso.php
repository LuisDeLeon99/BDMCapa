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
    $Niveles = $_POST['nivelesCurso'];
    $Gratis = $_POST['optionsRadios'];
    $Gratis = ($_POST['optionsRadios'] === 'true') ? true : false;

    $Titulo = $_POST['nombreCurso'];
    $Descripcion = $_POST['descripcionCurso']; 
    
    // Verificar si el título ya existe en la base de datos
    $stmt = $conn->prepare("CALL spVerificarTitulo(?, @pTituloExistente)");
    $stmt->bind_param("s", $Titulo);
    $stmt->execute();

    // Obtener el resultado de la verificación del título
    $result = $conn->query("SELECT @pTituloExistente AS TituloExistente");
    $row = $result->fetch_assoc();
    $TituloExistente = $row['TituloExistente'];

    // Verificar si el título ya existe
    if ($TituloExistente > 0) {
        // El título ya existe, mostrar un mensaje de error o realizar la acción correspondiente
        echo "El título del curso ya existe. Por favor, elige otro título.";
        exit();
    }
    
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
        $query = "CALL spGestionCursos('SE4','$idcur','$Niveles','$Costo','$Titulo','$Descripcion','$ImagenContenido','$Diploma','$Gratis','$Eliminado','$IDCat','$Creacion','$Inicio','$Cantidad','$ID_usuario')";
        $result = $conn->query($query);
        $Cantidad = 1;
        $row = $result->fetch_assoc();
        $idcur = $row['ID_curso'];
        header("Location: ../pages/cargarNiveles.html?3K32:Da=" . urlencode($Niveles) . "&or3Zfl4w=" . urlencode($idcur) . "&cantidad=" . urlencode($Cantidad));
        exit();
    }
   
}



$conn->close();
?>