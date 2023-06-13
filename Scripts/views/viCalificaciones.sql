USE bdm;

DROP VIEW IF EXISTS viCalificaciones;

CREATE VIEW viCalificaciones AS
SELECT CU.ID_alumno, CU.ID_curso, U.Nombre AS Alumno, C.Titulo AS Curso, CU.Progreso AS NivelCompletado, CU.Calif AS Calificacion
FROM Usuarios U
JOIN CursosUsuarios CU ON U.ID_usuario = CU.ID_alumno
JOIN Curso C ON CU.ID_curso = C.ID_curso;

