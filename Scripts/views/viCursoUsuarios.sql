USE bdm;

DROP VIEW IF EXISTS viCursosUsuarios;

CREATE VIEW viCursosUsuarios AS
SELECT
    cu.ID_curso,
    c.Titulo AS Curso,
    COUNT(cu.ID_alumno) AS AlumnosInscritos,
    AVG(cu.Progreso) AS NivelPromedio,
    calcularTotalVentas(cu.ID_curso) AS IngresosCurso,
    v.Pago AS FormaPago
FROM CursosUsuarios cu
JOIN Ventas v ON cu.ID_alumno = v.ID_usuario
JOIN DetalleVentas dv ON v.ID_ventas = dv.ID_Ventas AND cu.ID_curso = dv.ID_curso
JOIN Curso c ON cu.ID_curso = c.ID_curso
GROUP BY cu.ID_curso, c.Titulo, v.Pago
WITH ROLLUP;

