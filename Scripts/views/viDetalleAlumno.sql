USE bdm;

DROP VIEW IF EXISTS viDetalleAlumnos;

CREATE VIEW viDetalleAlumnos AS
SELECT
    cu.ID_curso,
    c.Titulo AS Curso,
    CONCAT(u.Nombre, ' ', u.Apaterno, ' ', u.Amaterno) AS Alumno,
    cu.Fecha AS FechaInscripcion,
    cu.Progreso AS NivelAvance,
    dv.PrecioUnitario AS PrecioPagado,
    p.Descripcion AS FormaPago,
    calcularPromedioCalificaciones(cu.ID_curso) AS PromedioCalificaciones
FROM CursosUsuarios cu
JOIN Usuarios u ON cu.ID_alumno = u.ID_usuario
JOIN DetalleVentas dv ON cu.ID_curso = dv.ID_curso
JOIN Ventas v ON dv.ID_Ventas = v.ID_ventas
JOIN Pago p ON v.Metodo = p.ID_pago
JOIN Curso c ON cu.ID_curso = c.ID_curso;

