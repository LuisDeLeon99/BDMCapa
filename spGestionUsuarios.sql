USE bdm;

DROP PROCEDURE IF EXISTS spGestionUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionUsuarios(
    IN Accion CHAR(3),
    IN ID_usuario INT,
    IN Nombre VARCHAR(30),
    IN Ap VARCHAR(30),
    IN Am VARCHAR(30),
    IN Pass VARCHAR(30),
    IN Rol BOOLEAN,
    IN Imagen BLOB,
    IN Genero BOOLEAN,
	IN Correo VARCHAR(30),
    IN Fecha Date, 
    IN Fechan Date,
    IN err BOOLEAN
    
)
BEGIN
    IF Accion = 'IN' THEN
        SET Fecha = NOW();
        SET Imagen = null;
        INSERT INTO Usuarios(ID_usuario, Nombre, Ap, Am, Pass, Rol, Imagen, Genero, Correo, Fecha, Fechan, err )
        VALUES(0, Nombre, Ap, Am, Pass, 1, null, 1, Correo, '2021-05-25', '2021-05-25',0 );
    END IF;
    
    IF Accion = 'UP' THEN
        UPDATE Usuarios
        SET ID_usuario = ID_usuario,
            Nombre = Nombre,
            Ap = Ap,
            Am = Am,
            Pass = Pass,
            Rol = Rol,
            Imagen = Imagen,
            Genero = Genero,
            Correo = Correo,
            Fechan = Fechan
            
        WHERE ID_usuario = ID_usuario;
    END IF;
    
    IF Accion = 'DE' THEN
        DELETE FROM Usuarios WHERE ID_usuario = ID_usuario; 
    END IF;  
    
    
    IF Accion = 'SE' THEN
        SELECT ID_usuario, Nombre, Ap, Am, Pass, Rol, Imagen, Genero, Correo, Fecha, Fechan, err
        FROM Usuarios WHERE ID_usuario = ID_usuario;
    END IF;
    
    
END //

DELIMITER ;
