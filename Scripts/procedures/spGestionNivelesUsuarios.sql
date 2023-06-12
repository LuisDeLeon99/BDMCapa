USE bdm;

DROP PROCEDURE IF EXISTS spGestionNivelesUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionNivelesUsuarios(
    IN p_Accion CHAR(3),
    IN p_ID_alumno INT,
    IN p_ID_curso INT,
    IN p_ID_nivel INT,
    IN p_Completado BOOL,
    IN p_FechaCompletado DATE
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO NivelesUsuarios (ID_alumno, ID_curso, ID_nivel, Completado, FechaCompletado)
        VALUES (p_ID_alumno, p_ID_curso, p_ID_nivel, p_Completado, p_FechaCompletado);
    END IF;

    IF p_Accion = 'UP' THEN
        UPDATE NivelesUsuarios
        SET Completado = 1,
            FechaCompletado = curdate()
        WHERE ID_alumno = p_ID_alumno AND ID_curso = p_ID_curso AND ID_nivel = p_ID_nivel;
    END IF;

    IF p_Accion = 'DE' THEN
        DELETE FROM NivelesUsuarios
        WHERE ID_alumno = p_ID_alumno AND ID_curso = p_ID_curso AND ID_nivel = p_ID_nivel;
    END IF;

    IF p_Accion = 'SE' THEN
        SELECT ID_alumno, ID_curso, ID_nivel, Completado, FechaCompletado
        FROM NivelesUsuarios
        WHERE ID_alumno = p_ID_alumno AND ID_curso = p_ID_curso AND ID_nivel = p_ID_nivel;
    END IF;
    
    IF p_Accion = 'SE2' THEN
        SELECT ID_alumno, ID_curso, ID_nivel, Completado, FechaCompletado
        FROM NivelesUsuarios;
    END IF;
    
END //

DELIMITER ;
