DROP VIEW IF EXISTS viCategoria;

CREATE VIEW viCategoria AS
SELECT
    C.IDCat,
    U.Nombre AS NombreUsuario,
    C.Categoria,
    C.Descripcion,
    C.creacion,
    C.catel
FROM
    Categoria AS C
    INNER JOIN Usuarios AS U ON C.ID_usuario = U.ID_usuario
WHERE
    C.catel = 0;