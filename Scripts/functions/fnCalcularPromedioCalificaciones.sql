USE bdm;

DROP FUNCTION IF EXISTS calcularPromedioCalificaciones;

DELIMITER //

CREATE FUNCTION calcularPromedioCalificaciones(ID_curso INT) RETURNS DECIMAL(5,2) DETERMINISTIC
BEGIN
    DECLARE promedio DECIMAL(5,2);
    
    SELECT AVG(Calif) INTO promedio
    FROM CursosUsuarios
    WHERE ID_curso = ID_curso;
    
    RETURN promedio;
END //

DELIMITER ;
