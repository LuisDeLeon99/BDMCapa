USE bdm;

DROP PROCEDURE IF EXISTS spLogin;
DELIMITER //

CREATE PROCEDURE spLogin (
	IN Usuario VARCHAR(30),
	IN Pass VARCHAR(30)
)
BEGIN
	UPDATE Usuarios
	SET err = err + 1
	WHERE Usuario = Usuario AND Pass <> Pass;

	SELECT Usuario, Pass, Rol, err, usel
	FROM Usuarios
	WHERE Usuario = Usuario AND Pass = Pass;
END //

DELIMITER ;