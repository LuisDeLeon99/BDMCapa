USE bdm;

DROP PROCEDURE IF EXISTS spGestionCategorias;

DELIMITER //

CREATE PROCEDURE spGestionCategorias(
    IN Accion CHAR(3),
    IN IDCat INT,
    IN ID_usuario INT,
    IN Categoria VARCHAR(30),
    IN Descripcion VARCHAR(50),
    IN creacion DATE,
    IN catel BOOLEAN
)
BEGIN
    IF Accion = 'IN' THEN
        INSERT INTO Categoria(ID_usuario, Categoria, Descripcion, creacion, catel)
        VALUES(ID_usuario, Categoria, Descripcion, CURDATE(), 0);
    END IF;

    IF Accion = 'UP' THEN
        UPDATE Categoria
        SET ID_usuario = ID_usuario,
            Categoria = Categoria,
            Descripcion = Descripcion,
            creacion = creacion,
            catel = catel
        WHERE IDCat = IDCat;
    END IF;

    IF Accion = 'BO' THEN
        UPDATE Categoria
        SET catel = 1
        WHERE IDCat = IDCat;
    END IF;

    IF Accion = 'DE' THEN
        DELETE FROM Categoria WHERE IDCat = IDCat; 
    END IF;

    IF Accion = 'SE' THEN
        SELECT IDCat, NombreUsuario, Categoria, Descripcion, creacion, catel
        FROM viCategoria WHERE IDCat = IDCat;
        
    END IF;
    
END //

DELIMITER ;