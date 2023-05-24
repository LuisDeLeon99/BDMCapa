<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
    exit();
}

$foto = array(
    'imagen' => base64_encode($_SESSION['imagen']),
);

header('Content-Type: application/json');
echo json_encode($foto);
?>