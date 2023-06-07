USE bdm;

DROP PROCEDURE IF EXISTS spGestionNiveles;

DELIMITER //

CREATE PROCEDURE spGestionNiveles(
	IN p_Accion CHAR(3),
    IN p_IDNiv INT,
    IN p_ID_curso INT,
    IN p_Nivel INT,
    IN p_Video LONGBLOB,
    IN p_Titulo VARCHAR(60),
    IN p_Descripcion VARCHAR(200),
    IN p_Completado BOOL
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO Niveles(ID_curso, Nivel, Video, Titulo, Descripcion, Completado)
        VALUES (p_ID_curso, p_Nivel, p_Video, p_Titulo, p_Descripcion, p_Completado);
    END IF;

    IF p_Accion = 'UP' THEN
        UPDATE Niveles
        SET Video = p_Video,
            Titulo = p_Titulo,
            Descripcion = p_Descripcion
        WHERE Nivel = p_Nivel AND ID_curso = p_ID_curso;
    END IF;

    IF p_Accion = 'DE' THEN
        DELETE FROM Niveles WHERE IDNiv = p_IDNiv;
    END IF;

    IF p_Accion = 'SE' THEN
        SELECT IDNiv, ID_curso, Nivel, Video, Titulo, Descripcion, Completado
        FROM Niveles WHERE IDNiv = p_IDNiv;
    END IF;
END //

DELIMITER ;
