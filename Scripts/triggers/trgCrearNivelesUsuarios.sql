USE bdm;

DROP TRIGGER IF EXISTS trgCrearNivelesUsuarios;

DELIMITER //

CREATE TRIGGER trgCrearNivelesUsuarios AFTER INSERT ON CursosUsuarios
FOR EACH ROW
BEGIN
    -- Obtener los niveles del curso
    DECLARE nivel_id INT;
    
    -- Cursor para obtener los ID de niveles del curso
    DECLARE cur_niveles CURSOR FOR
        SELECT IDNiv FROM Niveles WHERE ID_curso = NEW.ID_curso;
    
    -- Variables para almacenar los ID de nivel
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET nivel_id = NULL;
    
    -- Insertar registros en NivelesUsuarios para cada nivel del curso
    OPEN cur_niveles;
    
    read_loop: LOOP
        FETCH cur_niveles INTO nivel_id;
        IF nivel_id IS NULL THEN
            LEAVE read_loop;
        END IF;
        
        -- Insertar registro en NivelesUsuarios
        INSERT INTO NivelesUsuarios (ID_alumno, ID_curso, ID_nivel, Completado, FechaCompletado)
        VALUES (NEW.ID_alumno, NEW.ID_curso, nivel_id, 0, NULL);
    END LOOP;
    
    CLOSE cur_niveles;
END //

DELIMITER ;
