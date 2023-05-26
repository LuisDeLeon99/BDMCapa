USE bdm;

DROP PROCEDURE IF EXISTS spLogin;
DELIMITER //

CREATE PROCEDURE spLogin (
	IN Usuario VARCHAR(30),
	IN Pass VARCHAR(30)
)
BEGIN
	UPDATE Usuarios
	SET err = CASE WHEN err < 4 THEN err + 1 ELSE err END
	WHERE Usuario = usuarios.Usuario AND Pass <> usuarios.Pass;

	SELECT Usuario,Nombre, Apaterno, Amaterno,  Rol, Imagen, Genero, Correo, Fecha, Fechan, err,usel
	FROM Usuarios
	WHERE Usuario = usuarios.Usuario AND Pass = usuarios.Pass;
END //

DELIMITER ;