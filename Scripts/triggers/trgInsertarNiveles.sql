USE bdm;

DROP TRIGGER IF EXISTS trgInsertarNiveles;

DELIMITER //

CREATE TRIGGER trgInsertarNiveles AFTER INSERT ON Curso
FOR EACH ROW
BEGIN
    SET @nivel = NEW.Niveles;
    SET @nivel_actual = 1;
    
    WHILE @nivel > 0 DO
        INSERT INTO Niveles (ID_curso, Nivel, Video, Titulo, Descripcion, Premium)
        VALUES (NEW.ID_curso, @nivel_actual, '', '', '', 0);
        SET @nivel = @nivel - 1;
        SET @nivel_actual = @nivel_actual + 1;
    END WHILE;
END //

DELIMITER ;

