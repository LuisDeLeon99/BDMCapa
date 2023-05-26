USE bdm;

DROP PROCEDURE IF EXISTS spGestionUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionUsuarios(
    IN Accion CHAR(3),
    IN ID_usuario INT,
    IN Usuario VARCHAR(30),
    IN Nombre VARCHAR(30),
    IN Ap VARCHAR(30),
    IN Am VARCHAR(30),
    IN Pass VARCHAR(30),
    IN Rol INT,
    IN Imagen LONGBLOB,
    IN Genero BOOLEAN,
	IN Correo VARCHAR(30),
    IN Fecha Date, 
    IN Fechan Date,
    IN err INT,
    IN usel boolean
    
)
BEGIN
    IF Accion = 'IN' THEN
        SET Fecha = NOW();
        
        INSERT INTO Usuarios(Usuario,Nombre, Apaterno, Amaterno, Pass, Rol, Imagen, Genero, Correo, Fecha, Fechan, err,usel )
        VALUES( Usuario,Nombre, Ap, Am, Pass, Rol, Imagen, Genero, Correo, CURDATE(), Fechan,0,0 );
    END IF;
    
    IF Accion = 'UP' THEN
        UPDATE Usuarios
        SET Usuario = Usuario,
            Nombre = Nombre,
            Apaterno = Ap,
            Apaterno = Am,
            Pass = Pass,
            Rol = Rol,
            Imagen = Imagen,
            Genero = Genero,
            Correo = Correo,
            Fecha = CURDATE(),
            Fechan = Fechan
            
        WHERE ID_usuario = ID_usuario;
    END IF;
    
     IF Accion = 'BO' THEN
        UPDATE Usuarios
        SET usel = 1                
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
