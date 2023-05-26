USE bdm;

DROP VIEW IF EXISTS viKardex;

CREATE VIEW viKardex AS
SELECT cu.ID_curso, cu.ID_alumno, cu.ID_instructor, cu.Progreso, cu.Diploma, cu.Fecha, cu.FechaF,
       c.Titulo AS CursoTitulo, u.Nombre AS AlumnoNombre, u.Apaterno AS AlumnoApellido,
       uc.Categoria AS CursoCategoria, uc.FechaInicio AS CursoFechaInicio, uc.FechaFin AS CursoFechaFin,
       CASE WHEN cu.Progreso = 100 THEN 'Terminado' ELSE 'Incompleto' END AS EstadoCurso,       
       (SELECT MAX(Fecha) FROM CursosUsuarios WHERE ID_alumno = cu.ID_alumno AND ID_curso = cu.ID_curso) AS UltimaFechaInscripcion,
       (SELECT MAX(Fecha) FROM Niveles WHERE ID_curso = cu.ID_curso AND IDNiv IN (SELECT MAX(IDNiv) FROM Niveles WHERE ID_curso = cu.ID_curso)) AS UltimaFechaNivel,
       (SELECT FechaF FROM CursosUsuarios WHERE ID_alumno = cu.ID_alumno AND ID_curso = cu.ID_curso) AS FechaTerminacion
FROM CursosUsuarios cu
INNER JOIN Curso c ON cu.ID_curso = c.ID_curso
INNER JOIN Usuarios u ON cu.ID_alumno = u.ID_usuario
INNER JOIN Categoria uc ON c.IDCat = uc.IDCat
WHERE (cu.Fecha >= @FechaInicio OR @FechaInicio IS NULL)
  AND (cu.Fecha <= @FechaFin OR @FechaFin IS NULL)
  AND (uc.Categoria = @Categoria OR @Categoria IS NULL OR @Categoria = '')
  AND ((cu.Progreso = 100 AND @Terminado = 'Terminado') OR (@Terminado IS NULL OR @Terminado = ''))
  AND ((cu.Progreso < 100 AND @Activo = 'Activo') OR (@Activo IS NULL OR @Activo = ''));

