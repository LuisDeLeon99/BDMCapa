USE bdm;

DROP PROCEDURE IF EXISTS spGestionDetalleVentas;

DELIMITER //

CREATE PROCEDURE spGestionDetalleVentas(
    IN p_Accion CHAR(3),
    IN p_IDDetalle INT,
    IN p_ID_Ventas INT,
    IN p_ID_curso INT,
    IN p_Cantidad INT,
    IN p_PrecioUnitario DECIMAL(10,2),
    IN p_Subtotal DECIMAL(10,2)
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO DetalleVentas(ID_Ventas, ID_curso, Cantidad, PrecioUnitario, Subtotal)
        VALUES (p_ID_Ventas, p_ID_curso, p_Cantidad, p_PrecioUnitario, p_Subtotal);
    END IF;

    IF p_Accion = 'UP' THEN
        UPDATE DetalleVentas
        SET ID_Ventas = p_ID_Ventas,
            ID_curso = p_ID_curso,
            Cantidad = p_Cantidad,
            PrecioUnitario = p_PrecioUnitario,
            Subtotal = p_Subtotal
        WHERE ID_detalle = p_IDDetalle;
    END IF;

    IF p_Accion = 'DE' THEN
        DELETE FROM DetalleVentas WHERE ID_detalle = p_IDDetalle;
    END IF;

    IF p_Accion = 'SE' THEN
        SELECT ID_detalle, ID_Ventas, ID_curso, Cantidad, PrecioUnitario, Subtotal
        FROM DetalleVentas WHERE ID_detalle = p_IDDetalle;
    END IF;
END //

DELIMITER ;
