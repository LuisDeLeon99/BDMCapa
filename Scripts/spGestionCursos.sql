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
    IN IDCat INT
)
BEGIN
    IF Accion = 'IN' THEN
        INSERT INTO Curso(ID_curso, Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat)
        VALUES(ID_curso, Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, 0, 1);
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
            IDCat = IDCat
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
        SELECT ID_curso, Niveles, Costo, Titulo, Descripcion, Imagen, Diploma, Gratis, Eliminado, IDCat
        FROM Curso WHERE ID_curso = ID_curso;
    END IF;
    
END //

DELIMITER ;
