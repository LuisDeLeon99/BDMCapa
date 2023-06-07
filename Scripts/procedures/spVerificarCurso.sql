USE bdm;

DROP PROCEDURE IF EXISTS spVerificarTitulo;

DELIMITER //

CREATE PROCEDURE spVerificarTitulo(
    IN pTitulo VARCHAR(50),
    OUT pTituloExistente INT
)
BEGIN
    SELECT COUNT(*) INTO pTituloExistente
    FROM Curso
    WHERE Titulo = pTitulo;
END //

DELIMITER ;
