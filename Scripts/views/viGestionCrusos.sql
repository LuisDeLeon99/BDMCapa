USE bdm;

DROP VIEW IF EXISTS viGestionCursos;

CREATE VIEW viGestionCursos AS
SELECT
    C.ID_curso,
    C.Titulo,
    C.Descripcion,
    C.Costo,
    C.Imagen,
    C.ID_usuario,
    AVG(Com.Calif) AS CalificacionPromedio,
    
    COUNT(DV.ID_curso) AS Ventas,
    C.Creacion AS UltimaVenta,
    Cat.Categoria AS Categoria,
    Cat.IDCat AS IDCat,
    (SELECT COUNT(*) FROM Curso WHERE Eliminado = 0) AS TotalCurso
FROM
    Curso AS C
    LEFT JOIN Comentarios AS Com ON C.ID_curso = Com.ID_curso
    LEFT JOIN DetalleVentas AS DV ON C.ID_curso = DV.ID_curso
    LEFT JOIN Ventas AS V ON DV.ID_Ventas = V.ID_ventas
    LEFT JOIN Categoria AS Cat ON C.IDCat = Cat.IDCat
WHERE
    C.Eliminado = 0
GROUP BY
    C.ID_curso, C.Titulo, C.Descripcion, C.Costo, Cat.Categoria;
