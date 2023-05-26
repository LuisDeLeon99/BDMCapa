USE bdm;

DROP PROCEDURE IF EXISTS spVerificarUsuario;

DELIMITER //

CREATE PROCEDURE spVerificarUsuario(
    IN pUsuario VARCHAR(30),
    OUT pUsuarioExistente INT
)
BEGIN
    SELECT COUNT(*) INTO pUsuarioExistente
    FROM Usuarios
    WHERE usuario = pUsuario;
END //

DELIMITER ;
