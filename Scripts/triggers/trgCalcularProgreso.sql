USE bdm;

DROP TRIGGER IF EXISTS trgCalcularProgreso;

DELIMITER //

CREATE TRIGGER trgCalcularProgreso AFTER UPDATE ON Niveles
FOR EACH ROW
BEGIN
    DECLARE total_niveles INT;
    DECLARE niveles_completados INT;
    DECLARE progreso DECIMAL(5,2);
    
    -- Obtener el número total de niveles del curso
    SELECT Niveles INTO total_niveles FROM Curso WHERE ID_curso = NEW.ID_curso;
    
    -- Obtener la cantidad total de niveles completados por el alumno en ese curso
    SELECT COUNT(*) INTO niveles_completados FROM Niveles WHERE ID_curso = NEW.ID_curso AND completado = 1;
    
    -- Calcular el progreso en base a los niveles completados
    SET progreso = (niveles_completados * 100.0) / total_niveles;
    
    -- Actualizar el campo "Progreso" en la tabla CursosUsuarios
    UPDATE CursosUsuarios SET Progreso = progreso WHERE ID_curso = NEW.ID_curso AND ID_alumno = (
        SELECT ID_alumno FROM CursosUsuarios WHERE ID_curso = NEW.ID_curso AND ID_instructor = NEW.ID_instructor
    );
END //

DELIMITER ;
