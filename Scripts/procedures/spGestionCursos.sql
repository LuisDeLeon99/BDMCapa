USE bdm;

DROP PROCEDURE IF EXISTS spGestionCursos;

DELIMITER //

CREATE PROCEDURE spGestionCursos(
    IN p_Accion CHAR(3),
    IN p_ID_curso INT,
    IN p_Niveles INT,
    IN p_Costo DECIMAL(10,2),
    IN p_Titulo VARCHAR(50),
    IN p_Descripcion VARCHAR(200),
    IN p_Imagen LONGBLOB,
    IN p_Diploma LONGBLOB,
    IN p_Gratis BOOLEAN,
    IN p_Eliminado BOOLEAN,
    IN p_IDCat INT,
    IN p_Creacion DATE,
    IN p_Inicio INT,
    IN p_Cantidad INT,
    IN p_ID_usuario INT
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO Curso(Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat, Creacion,ID_usuario)
        VALUES(p_Niveles, p_Costo, p_Titulo, p_Descripcion, p_Imagen, p_Diploma, p_Gratis, 0, p_IDCat, CURDATE(), p_ID_usuario);
    END IF;

    IF p_Accion = 'UP' THEN
        UPDATE Curso
        SET Niveles = p_Niveles,
            Costo = p_Costo,
            Titulo = p_Titulo,
            Descripcion = p_Descripcion,
            Imagen = p_Imagen,
            Diploma = p_Diploma,
            Gratis = p_Gratis,
            Eliminado = p_Eliminado,
            IDCat = p_IDCat,
            Creacion = p_Creacion,
            ID_usuario = p_ID_usuario
        WHERE ID_curso = p_ID_curso;
    END IF;

    IF p_Accion = 'BO' THEN
        UPDATE Curso
        SET Eliminado = 1
        WHERE ID_curso = p_ID_curso;
    END IF;

    IF p_Accion = 'DE' THEN
        DELETE FROM Curso WHERE Curso.ID_curso = p_ID_curso; 
    END IF;

    IF p_Accion = 'SE' THEN
        SELECT Curso.ID_curso, Curso.Niveles, Curso.Costo, Curso.Titulo, Curso.Descripcion, Curso.Imagen, Curso.IDCat, Curso.Creacion, Curso.ID_usuario
        FROM Curso WHERE Curso.ID_curso = p_ID_curso;
    END IF;

    IF p_Accion = 'SE1' THEN
        IF p_IDCat <> 1 THEN
            SELECT viGestionCursos.ID_curso, viGestionCursos.Titulo,viGestionCursos.Costo, Categoria,viGestionCursos.Imagen, CalificacionPromedio,Ventas,UltimaVenta,Totalcurso
            FROM viGestionCursos
            WHERE viGestionCursos.IDCat = p_IDCat AND viGestionCursos.Titulo LIKE CONCAT('%', p_Titulo, '%')
            ORDER BY CalificacionPromedio DESC
            LIMIT p_Inicio, p_Cantidad;
        ELSE
            SELECT viGestionCursos.ID_curso, viGestionCursos.Titulo,viGestionCursos.Costo, Categoria,viGestionCursos.Imagen, CalificacionPromedio,Ventas,UltimaVenta,Totalcurso
            FROM viGestionCursos
            WHERE  viGestionCursos.Titulo LIKE CONCAT('%', p_Titulo, '%')
            ORDER BY CalificacionPromedio DESC
            LIMIT p_Inicio, p_Cantidad;
        END IF;
    END IF;

    IF p_Accion = 'SE2' THEN
        IF p_IDCat <> 1 THEN
            SELECT viGestionCursos.ID_curso, viGestionCursos.Titulo,viGestionCursos.Costo, Categoria,viGestionCursos.Imagen, CalificacionPromedio,Ventas,UltimaVenta,Totalcurso
            FROM viGestionCursos
            WHERE viGestionCursos.IDCat = p_IDCat AND viGestionCursos.Titulo LIKE CONCAT('%', p_Titulo, '%')
            ORDER BY Ventas DESC
            LIMIT p_Inicio, p_Cantidad;
        ELSE
            SELECT viGestionCursos.ID_curso, viGestionCursos.Titulo,viGestionCursos.Costo, Categoria,viGestionCursos.Imagen, CalificacionPromedio,Ventas,UltimaVenta,Totalcurso
            FROM viGestionCursos
            WHERE  viGestionCursos.Titulo LIKE CONCAT('%', p_Titulo, '%')
            ORDER BY Ventas DESC
            LIMIT p_Inicio, p_Cantidad;
        END IF;
    END IF;

     IF p_Accion = 'SE3' THEN
        IF p_IDCat <> 1 THEN
            SELECT viGestionCursos.ID_curso, viGestionCursos.Titulo,viGestionCursos.Costo, Categoria,viGestionCursos.Imagen, CalificacionPromedio,Ventas,UltimaVenta,Totalcurso
            FROM viGestionCursos
            WHERE viGestionCursos.IDCat = p_IDCat AND viGestionCursos.Titulo LIKE CONCAT('%', p_Titulo, '%')
            ORDER BY UltimaVenta DESC
            LIMIT p_Inicio, p_Cantidad;
        ELSE
            SELECT viGestionCursos.ID_curso, viGestionCursos.Titulo,viGestionCursos.Costo, Categoria,viGestionCursos.Imagen, CalificacionPromedio,Ventas,UltimaVenta,Totalcurso
            FROM viGestionCursos
            WHERE  viGestionCursos.Titulo LIKE CONCAT('%', p_Titulo, '%')
            ORDER BY UltimaVenta DESC
            LIMIT p_Inicio, p_Cantidad;
        END IF;
    END IF;
    IF p_Accion = 'SE4' THEN
        SELECT Curso.ID_curso
        FROM Curso WHERE Titulo = p_Titulo;
    END IF;
    
    IF p_Accion = 'SE5' THEN
    SELECT viGestionCursos.ID_curso, viGestionCursos.Costo, viGestionCursos.Titulo, viGestionCursos.Imagen, viGestionCursos.ID_usuario,
			(SELECT SUM(Costo) FROM viGestionCursos ) AS SumaCostos
		FROM viGestionCursos 
		WHERE viGestionCursos.ID_curso = p_ID_curso;
	END IF;
    
    IF p_Accion = 'SE6' THEN
    SELECT viGestionCursos.ID_curso, viGestionCursos.Costo, viGestionCursos.Titulo, viGestionCursos.Imagen, viGestionCursos.ID_usuario			
		FROM viGestionCursos 
		WHERE viGestionCursos.ID_usuario = p_ID_usuario;
	END IF;
    
    IF p_Accion = 'SE7' THEN
    SELECT viComprasUsuario.ID_usuario, viComprasUsuario.ID_curso	
		FROM viComprasUsuario 
		WHERE viComprasUsuario.ID_usuario = p_ID_usuario and viComprasUsuario.ID_curso = p_ID_curso;
	END IF;
    IF p_Accion = 'SE8' THEN
    SELECT Curso.ID_curso, Curso.Costo, Curso.Titulo, Curso.Imagen, Curso.ID_usuario			
		FROM Curso 
		WHERE Curso.ID_usuario = p_ID_usuario;
	END IF;
    
END //

DELIMITER ;
