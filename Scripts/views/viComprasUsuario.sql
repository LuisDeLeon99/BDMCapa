USE bdm;

DROP VIEW IF EXISTS viComprasUsuario;

CREATE VIEW viComprasUsuario AS
SELECT U.Usuario, C.Titulo, C.ID_curso,V.ID_usuario
FROM Usuarios U
JOIN Ventas V ON U.ID_usuario = V.ID_usuario
JOIN DetalleVentas DV ON V.ID_ventas = DV.ID_Ventas
JOIN Curso C ON DV.ID_curso = C.ID_curso;
