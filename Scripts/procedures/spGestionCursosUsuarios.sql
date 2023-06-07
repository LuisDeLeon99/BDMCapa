USE bdm;

DROP PROCEDURE IF EXISTS spGestionCursosUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionCursosUsuarios(
    IN p_Accion CHAR(3),
    IN p_ID_curso INT,
    IN p_ID_alumno INT,
    IN p_ID_instructor INT,
    IN p_Progreso DECIMAL(5,2),
    IN p_Diploma BLOB,
    IN p_Fecha DATE,
    IN p_FechaF DATE
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO CursosUsuarios (ID_curso, ID_alumno, ID_instructor, Progreso, Diploma, Fecha, FechaF)
        VALUES (p_ID_curso, p_ID_alumno, p_ID_instructor, p_Progreso, p_Diploma, p_Fecha, p_FechaF);
    END IF;
    
    IF p_Accion = 'UP' THEN
        UPDATE CursosUsuarios
        SET Progreso = p_Progreso,
            Diploma = p_Diploma,
            Fecha = p_Fecha,
            FechaF = p_FechaF
        WHERE ID_curso = p_ID_curso AND ID_alumno = p_ID_alumno;
    END IF;
    
    IF p_Accion = 'DE' THEN
        DELETE FROM CursosUsuarios
        WHERE ID_curso = p_ID_curso AND ID_alumno = p_ID_alumno;
    END IF;
END //

DELIMITER ;

