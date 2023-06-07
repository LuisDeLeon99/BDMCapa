<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // No hay sesión, redirigir al usuario a otra página o mostrar un mensaje de error
    http_response_code(302);
    exit();
}

if (isset($_SESSION['usuario'])) {
    $ID_usuario = $_SESSION['ID_usuario'];
    $payload = json_decode(file_get_contents('php://input'), true);

    if (isset($payload['metodoPago'])) {
        if ($payload['metodoPago'] == 'Tarjeta de crédito') $metodoPago = 1;
        if ($payload['metodoPago'] == 'Tarjeta de débito') $metodoPago = 2;
        if ($payload['metodoPago'] == 'Transferencia bancaria') $metodoPago = 3;
        if ($payload['metodoPago'] == 'PayPal') $metodoPago = 4;
        if ($payload['metodoPago'] == 'Criptomoneda') $metodoPago = 5;
    } else {
        http_response_code(302);
        exit();
    }
    
    if (isset($payload['precio'])) {
        $precio = $payload['precio'];
    } else {
        http_response_code(302);
        exit();
    }
    
    if (isset($payload['cursosResponse'])) {
        // Obtener el array cursosResponse del payload
        $cursosResponse = $payload['cursosResponse'];
    }

    // Verificar si el array "carrito" existe en la sesión
    $carrito = $_SESSION['carrito'];

    $accion = 'IN';
    $id = 0;
    $Creacion = '2000-05-05'; 
    
    $query = "CALL spGestionVentas('$accion', @id, '$ID_usuario', '$Creacion', '$precio', '$precio', '$metodoPago')";
    $result = $conn->query($query);

    $idVentasQuery = "SELECT @id AS idVentas";
    $idVentasResult = $conn->query($idVentasQuery);
    if ($idVentasResult !== false && $idVentasResult->num_rows > 0) {
        $row = $idVentasResult->fetch_assoc();
        $idVentas = $row['idVentas'];
    }
    $idVentasResult->free();
    
    $response = array(
        'status' => 'error',
        'message' => 'compra realizada.'
    );
    
    
    $cantidad = 1;
    $results_array = array();
    
    foreach ($cursosResponse as $curso) {
        
      $cursoID = $curso['ID_curso'];
      $costo = $curso['Costo'];
      $instr = $curso['ID_usuario'];
      $query3 = "CALL spGestionDetalleVentas('$accion', '0', '$idVentas', '$cursoID', '$cantidad', '$costo', '$costo')";
      $result3 = $conn->query($query3);

      $query4 = "CALL spGestionCursosUsuarios('$accion', '$cursoID', '$ID_usuario', '$instr', '0', '','$Creacion','$Creacion')";
      $result4 = $conn->query($query4);
      

    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>