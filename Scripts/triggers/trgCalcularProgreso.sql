USE bdm;

DROP TRIGGER IF EXISTS trgCalcularProgreso;

DELIMITER //

CREATE TRIGGER trgCalcularProgreso AFTER UPDATE ON NivelesUsuarios
FOR EACH ROW
BEGIN
    DECLARE total_niveles INT;
    DECLARE niveles_completados INT;
    DECLARE progreso DECIMAL(5,2);
    
    
    SELECT COUNT(*) INTO total_niveles FROM NivelesUsuarios WHERE ID_curso = NEW.ID_curso;
    
   
    SELECT COUNT(*) INTO niveles_completados FROM NivelesUsuarios WHERE ID_curso = NEW.ID_curso AND Completado = 1;
    
    
    SET progreso = (niveles_completados * 100.0) / total_niveles;
    
    
    CREATE TEMPORARY TABLE IF NOT EXISTS TempCursosUsuarios AS (
        SELECT ID_curso, ID_alumno
        FROM CursosUsuarios
        WHERE ID_curso = NEW.ID_curso
    );
    
    
    UPDATE CursosUsuarios
    SET Progreso = progreso
    WHERE ID_curso = NEW.ID_curso AND ID_alumno IN (
        SELECT ID_alumno FROM TempCursosUsuarios
    );
    
    
    DROP TEMPORARY TABLE IF EXISTS TempCursosUsuarios;
END //

DELIMITER ;
