USE bdm;

DROP PROCEDURE IF EXISTS spGestionCursosUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionCursosUsuarios(
    IN Accion CHAR(3),
    IN ID_curso INT,
    IN ID_alumno INT,
    IN ID_instructor INT,
    IN Progreso DECIMAL(5,2),
    IN Diploma BLOB,
    IN Fecha DATE,
    IN FechaF DATE
)
BEGIN
    IF Accion = 'IN' THEN
        INSERT INTO CursosUsuarios (ID_curso, ID_alumno, ID_instructor, Progreso, Diploma, Fecha, FechaF)
        VALUES (ID_curso, ID_alumno, ID_instructor, Progreso, Diploma, Fecha, FechaF);
    END IF;
    
    IF Accion = 'UP' THEN
        UPDATE CursosUsuarios
        SET Progreso = Progreso,
            Diploma = Diploma,
            Fecha = Fecha,
            FechaF = FechaF
        WHERE ID_curso = ID_curso AND ID_alumno = ID_alumno;
    END IF;
    
    IF Accion = 'DE' THEN
        DELETE FROM CursosUsuarios
        WHERE ID_curso = ID_curso AND ID_alumno = ID_alumno;
    END IF;
END //

DELIMITER ;
