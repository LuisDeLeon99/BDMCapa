USE bdm;

DROP VIEW IF EXISTS viKardex;

CREATE VIEW viKardex AS
SELECT
    cu.ID_alumno,
    CONCAT(u.Nombre, ' ', u.Apaterno, ' ', u.Amaterno) AS Alumno,
    cu.ID_curso,
    c.Titulo AS Curso,
    cat.Categoria AS Categoria,
    cu.Fecha AS FechaInscripcion,
    cu.FechaF AS FechaTerminacion,
    CASE
        WHEN nu.Completado = 100 THEN 'Completo'
        ELSE 'Incompleto'
    END AS ProgresoCurso,
    CASE
        WHEN c.Eliminado = 1 THEN 'Inactivo'
        ELSE 'Activo'
    END AS EstadoCurso
FROM CursosUsuarios cu
JOIN Usuarios u ON cu.ID_alumno = u.ID_usuario
JOIN Curso c ON cu.ID_curso = c.ID_curso
JOIN Categoria cat ON c.IDCat = cat.IDCat
LEFT JOIN NivelesUsuarios nu ON cu.ID_curso = nu.ID_curso AND cu.ID_alumno = nu.ID_alumno
GROUP BY cu.ID_alumno, cu.ID_curso, c.Titulo, cat.Categoria;

