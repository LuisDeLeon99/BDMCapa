<?php

class Categoria {
    private $IDCat;
    private $ID_usuario;
    private $Categoria;
    private $Descripcion;
    private $creacion;
    private $catel;
    
    public function __construct($IDCat, $ID_usuario, $Categoria, $Descripcion, $creacion) {
        $this->IDCat = $IDCat;
        $this->ID_usuario = $ID_usuario;
        $this->Categoria = $Categoria;
        $this->Descripcion = $Descripcion;
        $this->creacion = $creacion;
        
    }
    
    // Getters
    public function getIDCat() {
        return $this->IDCat;
    }
    
    public function getIDUsuario() {
        return $this->ID_usuario;
    }
    
    public function getCategoria() {
        return $this->Categoria;
    }
    
    public function getDescripcion() {
        return $this->Descripcion;
    }
    
    public function getCreacion() {
        return $this->creacion;
    }
    
    
    // Setters
    public function setIDCat($IDCat) {
        $this->IDCat = $IDCat;
    }
    
    public function setIDUsuario($ID_usuario) {
        $this->ID_usuario = $ID_usuario;
    }
    
    public function setCategoria($Categoria) {
        $this->Categoria = $Categoria;
    }
    
    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }
    
    public function setCreacion($creacion) {
        $this->creacion = $creacion;
    }
    


    public static function obtenerCategorias() {
        // Configuración de la conexión a la base de datos
        require_once 'conexion.php';
        // Verificar si la conexión fue exitosa
       

        // Llamada al stored procedure para obtener las categorías
        $accion = 'SE1';
        $IDCat = null;
        $ID_usuario = null;
        $Categoria = null;
        $Descripcion = null;
        $creacion = null;
        $catel = null;
        echo 'aantes' ;
        // Preparar y ejecutar la sentencia
        $stmt = mysqli_prepare($conexion, "CALL spGestionCategorias(?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sissisi", $accion, $IDCat, $ID_usuario, $Categoria, $Descripcion, $creacion, $catel);
        mysqli_stmt_execute($stmt);
        echo 'Error en el stored procedure: despues' ;
        return 0;   
        
        // Verificar si se obtuvieron resultados
        $resultado = mysqli_stmt_get_result($stmt);
        if ($resultado) {
            // Array para almacenar las categorías
            $categorias = array();

            // Recorrer los resultados y crear objetos Categoria
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $categoria = new Categoria(
                    $fila['IDCat'],
                    $fila['NombreUsuario'],
                    $fila['Categoria'],
                    $fila['Descripcion'],
                    $fila['creacion'],
                   
                );
                $categorias[] = $categoria;
            }

            // Liberar los resultados
            mysqli_free_result($resultado);

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);

            return $categorias;
        } else {
            // Error al ejecutar el stored procedure
            echo 'Error en el stored procedure: ' . mysqli_error($conexion);
            mysqli_close($conexion);
            return null;
        }
    }
}

?>
