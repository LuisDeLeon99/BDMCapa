<?php
function validarContrasena($contrasena) {
  
  if (strlen($contrasena) < 8) {
    return false;
  }
  
  
  if (!preg_match('/[a-z]/', $contrasena)) {
    return false;
  }
  
 
  if (!preg_match('/[A-Z]/', $contrasena)) {
    return false;
  }
  
  
  if (!preg_match('/\d/', $contrasena)) {
    return false;
  }
  
  
  if (!preg_match('/[^\w\s]/', $contrasena)) {
    return false;
  }
  
  
  return true;
}
?>