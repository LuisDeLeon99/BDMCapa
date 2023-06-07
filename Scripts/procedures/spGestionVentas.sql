USE bdm;

DROP PROCEDURE IF EXISTS spGestionVentas;

DELIMITER //

CREATE PROCEDURE spGestionVentas(
    IN p_Accion CHAR(3),
    INOUT p_IDVentas INT,
    IN p_ID_usuario INT,
    IN p_Fecha DATE,
    IN p_Total DECIMAL(10,2),
    IN p_Pago DECIMAL(10,2),
    IN p_Metodo INT
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO Ventas(ID_usuario, Fecha, Total, Pago, Metodo)
        VALUES (p_ID_usuario, CURDATE(), p_Total, p_Pago, p_Metodo);
        SET p_IDVentas = LAST_INSERT_ID();
    END IF;

    IF p_Accion = 'UP' THEN
        UPDATE Ventas
        SET ID_usuario = p_ID_usuario,
            Fecha = p_Fecha,
            Total = p_Total,
            Pago = p_Pago,
            Metodo = p_Metodo
        WHERE ID_ventas = p_IDVentas;
    END IF;

    IF p_Accion = 'DE' THEN
        DELETE FROM Ventas WHERE ID_ventas = p_IDVentas;
    END IF;

    IF p_Accion = 'SE' THEN
        SELECT ID_ventas
        FROM Ventas WHERE ID_ventas = p_IDVentas;
    END IF;
END //

DELIMITER ;
