USE bdm;

DROP VIEW IF EXISTS viCursosUsuarios;

CREATE VIEW viCursosUsuarios AS
SELECT
    cu.ID_curso,
    c.Titulo AS Curso,
    COUNT(DISTINCT cu.ID_alumno) AS AlumnosInscritos,
    AVG(cu.Progreso) AS NivelPromedio,
    SUM(dv.Subtotal) AS IngresosCurso,
    p.Descripcion AS FormaPago,
    SUM(dv.Subtotal) AS TotalVentas
FROM CursosUsuarios cu
JOIN Curso c ON cu.ID_curso = c.ID_curso
LEFT JOIN Ventas v ON cu.ID_alumno = v.ID_usuario
LEFT JOIN DetalleVentas dv ON v.ID_ventas = dv.ID_Ventas AND cu.ID_curso = dv.ID_curso
LEFT JOIN Pago p ON v.Metodo = p.ID_pago
GROUP BY cu.ID_curso, c.Titulo;



