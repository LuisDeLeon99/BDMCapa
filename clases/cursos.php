<?php

class Curso {
    // Propiedades privadas de la clase
    private $ID_curso;
    private $Titulo;
    private $Descripcion;
    private $Costo;
    private $Imagen;
    private $CalificacionPromedio;
    private $Ventas;
    private $UltimaVenta;
    private $Categoria;

    // Constructor de la clase
    public function __construct($ID_curso, $Titulo, $Descripcion, $Costo, $Imagen, $CalificacionPromedio, $Ventas, $UltimaVenta, $Categoria) {
        $this->ID_curso = $ID_curso;
        $this->Titulo = $Titulo;
        $this->Descripcion = $Descripcion;
        $this->Costo = $Costo;
        $this->Imagen = $Imagen;
        $this->CalificacionPromedio = $CalificacionPromedio;
        $this->Ventas = $Ventas;
        $this->UltimaVenta = $UltimaVenta;
        $this->Categoria = $Categoria;
    }

    // Métodos para obtener y establecer las propiedades (getters y setters)

    public function getIDCurso() {
        return $this->ID_curso;
    }

    public function getTitulo() {
        return $this->Titulo;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getCosto() {
        return $this->Costo;
    }

    public function getImagen() {
        return $this->Imagen;
    }

    public function getCalificacionPromedio() {
        return $this->CalificacionPromedio;
    }

    public function getVentas() {
        return $this->Ventas;
    }

    public function getUltimaVenta() {
        return $this->UltimaVenta;
    }

    public function getCategoria() {
        return $this->Categoria;
    }

    // Método estático para obtener todos los cursos desde la vista
    public static function obtenerCursos($accion, $pagina) {
        require_once 'conexion.php';
    
        // Cálculo de la posición de inicio para la paginación
        $cursosPorPagina = 12;
        $inicio = ($pagina - 1) * $cursosPorPagina;
    
        // Consulta para llamar al procedimiento almacenado según la acción y la paginación
        $consulta = "";
    
        if ($accion === 'SE1') {
            $consulta = "CALL spGestionCursosSE1($inicio, $cursosPorPagina)";
        } elseif ($accion === 'SE2') {
            $consulta = "CALL spGestionCursosSE2($inicio, $cursosPorPagina)";
        } elseif ($accion === 'SE3') {
            $consulta = "CALL spGestionCursosSE3($inicio, $cursosPorPagina)";
        } else {
            // Acción no válida
            return null;
        }
    
        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $consulta);
    
        // Verificar si se obtuvieron resultados
        if ($resultado) {
            // Array para almacenar los cursos
            $cursos = array();
    
            // Recorrer los resultados y crear objetos Curso
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $curso = new Curso(
                    $fila['ID_curso'],
                    $fila['Titulo'],
                    $fila['Descripcion'],
                    $fila['Costo'],
                    $fila['Imagen'],
                    $fila['CalificacionPromedio'],
                    $fila['Ventas'],
                    $fila['UltimaVenta'],
                    $fila['Categoria']
                );
                $cursos[] = $curso;
            }
    
            // Liberar los resultados
            mysqli_free_result($resultado);
    
            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
    
            return $cursos;
        } else {
            // Error al ejecutar la consulta
            echo 'Error en la consulta: ' . mysqli_error($conexion);
            mysqli_close($conexion);
            return null;
        }
    }
}


?>
