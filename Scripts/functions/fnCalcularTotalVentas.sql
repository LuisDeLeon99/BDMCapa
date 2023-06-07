USE bdm;

DROP FUNCTION IF EXISTS calcularTotalVentas;

DELIMITER //

CREATE FUNCTION calcularTotalVentas(ID_curso INT) RETURNS DECIMAL(10,2) DETERMINISTIC
BEGIN
    DECLARE total DECIMAL(10,2);
    
    SELECT SUM(Subtotal) INTO total
    FROM DetalleVentas
    WHERE ID_curso = ID_curso;
    
    RETURN total;
END //

DELIMITER ;