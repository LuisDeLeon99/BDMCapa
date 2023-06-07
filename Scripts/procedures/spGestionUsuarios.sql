USE bdm;

DROP PROCEDURE IF EXISTS spGestionUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionUsuarios(
    IN p_Accion CHAR(3),
    IN p_ID_usuario INT,
    IN p_Usuario VARCHAR(30),
    IN p_Nombre VARCHAR(30),
    IN p_Ap VARCHAR(30),
    IN p_Am VARCHAR(30),
    IN p_Pass VARCHAR(30),
    IN p_Rol INT,
    IN p_Imagen LONGBLOB,
    IN p_Genero BOOLEAN,
	IN p_Correo VARCHAR(30),
    IN p_Fecha DATE, 
    IN p_Fechan DATE,
    IN p_err INT,
    IN p_usel BOOLEAN
    
)
BEGIN
    IF p_Accion = 'IN' THEN
        SET p_Fecha = NOW();
        
        INSERT INTO Usuarios(Usuario,Nombre, Apaterno, Amaterno, Pass, Rol, Imagen, Genero, Correo, Fecha, Fechan, err,usel )
        VALUES( p_Usuario, p_Nombre, p_Ap, p_Am, p_Pass, p_Rol, p_Imagen, p_Genero, p_Correo, CURDATE(), p_Fechan, 0, 0 );
    END IF;
    
    IF p_Accion = 'UP' THEN
        UPDATE Usuarios
        SET Usuario = p_Usuario,
            Nombre = p_Nombre,
            Apaterno = p_Ap,
            Apaterno = p_Am,
            Pass = p_Pass,
            Rol = p_Rol,
            Imagen = p_Imagen,
            Genero = p_Genero,
            Correo = p_Correo,
            Fecha = CURDATE(),
            Fechan = p_Fechan
            
        WHERE ID_usuario = p_ID_usuario;
    END IF;
    
     IF p_Accion = 'BO' THEN
        UPDATE Usuarios
        SET usel = 1                
        WHERE ID_usuario = p_ID_usuario;
    END IF;
    
    IF p_Accion = 'DE' THEN
        DELETE FROM Usuarios WHERE ID_usuario = p_ID_usuario; 
    END IF;  
    
    
    IF p_Accion = 'SE' THEN
        SELECT ID_usuario, Nombre, Ap, Am, Pass, Rol, Imagen, Genero, Correo, Fecha, Fechan, err
        FROM Usuarios WHERE ID_usuario = p_ID_usuario;
    END IF;
    
    
END //

DELIMITER ;
