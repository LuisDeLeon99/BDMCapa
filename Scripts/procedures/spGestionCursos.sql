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
    IN Cantidad INT
)
BEGIN
    IF Accion = 'IN' THEN
        INSERT INTO Curso(Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat, Creacion)
        VALUES(Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, 0, IDCat, CURDATE());
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
            Creacion = Creacion
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
        SELECT ID_curso, Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat, Creacion
        FROM Curso WHERE ID_curso = ID_curso;
    END IF;

    IF Accion = 'SE1' THEN
        IF IDCat <> 1 THEN
            SELECT ID_curso, Titulo, CalificacionPromedio
            FROM viGestionCursos
            WHERE IDCat = IDCat
            ORDER BY CalificacionPromedio DESC
            LIMIT Inicio, Cantidad;
        ELSE
            SELECT ID_curso, Titulo, CalificacionPromedio
            FROM viGestionCursos
            ORDER BY CalificacionPromedio DESC
            LIMIT Inicio, Cantidad;
        END IF;
    END IF;

    IF Accion = 'SE2' THEN
        IF IDCat <> 1 THEN
            SELECT ID_curso, Titulo, Ventas
            FROM viGestionCursos
            WHERE IDCat = IDCat
            ORDER BY Ventas DESC
            LIMIT Inicio, Cantidad;
        ELSE
            SELECT ID_curso, Titulo, Ventas
            FROM viGestionCursos
            ORDER BY Ventas DESC
            LIMIT Inicio, Cantidad;
        END IF;
    END IF;

     IF Accion = 'SE3' THEN
        IF IDCat <> 1 THEN
            SELECT ID_curso, Titulo, UltimaVenta
            FROM viGestionCursos
            WHERE IDCat = IDCat
            ORDER BY UltimaVenta DESC
            LIMIT Inicio, Cantidad;
        ELSE
            SELECT ID_curso, Titulo, UltimaVenta
            FROM viGestionCursos
            ORDER BY UltimaVenta DESC
            LIMIT Inicio, Cantidad;
        END IF;
    END IF;
END //

DELIMITER ;
