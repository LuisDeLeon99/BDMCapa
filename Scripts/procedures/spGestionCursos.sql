USE bdm;

DROP PROCEDURE IF EXISTS spGestionCursos;

DELIMITER //

CREATE PROCEDURE spGestionCursos(
    IN Accion CHAR(3),
    IN ID_curso INT,
    IN Niveles INT,
    IN Costo DECIMAL(10,2),
    IN Titulo VARCHAR(30),
    IN Descripcion VARCHAR(50),
    IN Imagen LONGBLOB,
    IN Diploma LONGBLOB,
    IN Gratis BOOLEAN,
    IN Eliminado BOOLEAN,
    IN IDCat INT,
    IN Creacion DATE,
    IN Inicio INT,
    IN Cantidad INT,
    IN ID_usuario INT
)
BEGIN
    IF Accion = 'IN' THEN
        INSERT INTO Curso(Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat, Creacion,ID_usuario)
        VALUES(Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, 0, IDCat, CURDATE(),ID_usuario);
    END IF;

    IF Accion = 'UP' THEN
        UPDATE Curso
        SET Niveles = Niveles,
            Costo = Costo,
            Titulo = Titulo,
            Descripcion = Descripcion,
            Imagen = Imagen,
            Diploma = Diploma,
            Gratis = Gratis,
            Eliminado = Eliminado,
            IDCat = IDCat,
            Creacion = Creacion,
            ID_usuario = ID_usuario
        WHERE ID_curso = ID_curso;
    END IF;

    IF Accion = 'BO' THEN
        UPDATE Curso
        SET Eliminado = 1
        WHERE ID_curso = ID_curso;
    END IF;

    IF Accion = 'DE' THEN
        DELETE FROM Curso WHERE ID_curso = ID_curso; 
    END IF;

    IF Accion = 'SE' THEN
        SELECT ID_curso, Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat, Creacion, ID_usuario
        FROM Curso WHERE ID_curso = ID_curso;
    END IF;

    IF Accion = 'SE1' THEN
        IF IDCat <> 1 THEN
            SELECT ID_curso, Titulo,Costo, Categoria,Imagen, CalificacionPromedio,Ventas,UltimaVenta
            FROM viGestionCursos
            WHERE viGestionCursos.IDCat = IDCat
            ORDER BY CalificacionPromedio DESC;
            
        ELSE
            SELECT ID_curso, Titulo, Costo,Categoria,Imagen, CalificacionPromedio,Ventas,UltimaVenta
            FROM viGestionCursos
            
            ORDER BY CalificacionPromedio DESC
            LIMIT Inicio, Cantidad;
        END IF;
    END IF;

    IF Accion = 'SE2' THEN
        IF IDCat <> 1 THEN
            SELECT ID_curso, Titulo, Costo,Categoria,Imagen, CalificacionPromedio,Ventas,UltimaVenta
            FROM viGestionCursos
            WHERE viGestionCursos.IDCat = IDCat
            ORDER BY Ventas DESC
            LIMIT Inicio, Cantidad;
        ELSE
            SELECT ID_curso, Titulo, Costo,Categoria,Imagen, CalificacionPromedio,Ventas,UltimaVenta
            FROM viGestionCursos
            
            ORDER BY Ventas DESC
            LIMIT Inicio, Cantidad;
        END IF;
    END IF;

     IF Accion = 'SE3' THEN
        IF IDCat <> 1 THEN
            SELECT ID_curso, Titulo, Costo,Categoria,Imagen, CalificacionPromedio,Ventas,UltimaVenta
            FROM viGestionCursos
            WHERE viGestionCursos.IDCat = IDCat
            ORDER BY UltimaVenta DESC
            LIMIT Inicio, Cantidad;
        ELSE
            SELECT ID_curso, Titulo, Costo,Categoria,Imagen, CalificacionPromedio,Ventas,UltimaVenta
            FROM viGestionCursos
            
            ORDER BY UltimaVenta DESC
            LIMIT Inicio, Cantidad;
        END IF;
    END IF;
END //

DELIMITER ;
