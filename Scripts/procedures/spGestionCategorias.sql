USE bdm;

DROP PROCEDURE IF EXISTS spGestionCategorias;

DELIMITER //

CREATE PROCEDURE spGestionCategorias(
    IN p_Accion CHAR(3),
    IN p_IDCat INT ,
    IN p_ID_usuario INT,
    IN p_Categoria VARCHAR(50),
    IN p_Descripcion VARCHAR(200),
    IN p_Creacion DATE,
    IN p_Catel BOOLEAN
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO Categoria(ID_usuario, Categoria, Descripcion, creacion, catel)
        VALUES(p_ID_usuario, p_Categoria, p_Descripcion, CURDATE(), 0);
    END IF;

    IF p_Accion = 'UP' THEN
        UPDATE Categoria
        SET ID_usuario = p_ID_usuario,
            Categoria = p_Categoria,
            Descripcion = p_Descripcion,
            creacion = p_Creacion,
            catel = p_Catel
        WHERE IDCat = p_IDCat;
    END IF;

    IF p_Accion = 'BO' THEN
        UPDATE Categoria
        SET catel = 1
        WHERE IDCat = p_IDCat;
    END IF;

    IF p_Accion = 'DE' THEN
        DELETE FROM Categoria WHERE IDCat = p_IDCat; 
    END IF;

    IF p_Accion = 'SE' THEN
        SELECT IDCat, NombreUsuario, Categoria, Descripcion, creacion, catel
        FROM viCategoria WHERE IDCat = p_IDCat;
        
    END IF;
    
    IF p_Accion = 'SE1' THEN
        SELECT viCategoria.IDCat, viCategoria.NombreUsuario, viCategoria.Categoria, viCategoria.Descripcion, viCategoria.creacion, viCategoria.catel
        FROM viCategoria ;
    END IF;
    
END //

DELIMITER ;
