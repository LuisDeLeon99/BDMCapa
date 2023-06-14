USE bdm;

DROP TRIGGER IF EXISTS trgCalcularProgreso;

DELIMITER //

CREATE TRIGGER trgCalcularProgreso AFTER UPDATE ON NivelesUsuarios
FOR EACH ROW
BEGIN
    DECLARE total_niveles INT;
    DECLARE niveles_completados INT;
    DECLARE progreso DECIMAL(5,2);
    
    -- Calcular el total de niveles para el curso y el alumno actual
    SELECT COUNT('ID_curso') INTO total_niveles FROM NivelesUsuarios WHERE ID_curso = NEW.ID_curso AND ID_alumno = NEW.ID_alumno;
    
    -- Calcular la cantidad de niveles completados para el curso y el alumno actual
    SELECT COUNT(*) INTO niveles_completados FROM NivelesUsuarios WHERE ID_curso = NEW.ID_curso AND ID_alumno = NEW.ID_alumno AND Completado = 1;
    
    -- Calcular el progreso
    SET progreso = (niveles_completados * 100.0) / total_niveles;
    
    -- Actualizar el campo Progreso en la tabla CursosUsuarios solo para el curso y el alumno actual
    UPDATE CursosUsuarios
    SET Progreso = progreso
    WHERE ID_curso = NEW.ID_curso AND ID_alumno = NEW.ID_alumno;
    
END //

DELIMITER ;
