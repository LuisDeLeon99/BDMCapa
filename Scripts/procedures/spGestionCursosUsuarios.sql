USE bdm;

DROP PROCEDURE IF EXISTS spGestionCursosUsuarios;

DELIMITER //

CREATE PROCEDURE spGestionCursosUsuarios(
    IN p_Accion CHAR(3),
    IN p_ID_curso INT,
    IN p_ID_alumno INT,
    IN p_ID_instructor INT,
    IN p_Progreso DECIMAL(5,2),
    IN p_Diploma BLOB,
    IN p_Fecha DATE,
    IN p_FechaF DATE
)
BEGIN
    IF p_Accion = 'IN' THEN
        INSERT INTO CursosUsuarios (ID_curso, ID_alumno, ID_instructor, Progreso, Diploma, Fecha, FechaF)
        VALUES (p_ID_curso, p_ID_alumno, p_ID_instructor, 0, '', CURDATE(), null);
    END IF;
    
    IF p_Accion = 'UP' THEN
        UPDATE CursosUsuarios
        SET Progreso = p_Progreso,
            Diploma = p_Diploma,
            Fecha = p_Fecha,
            FechaF = p_FechaF
        WHERE ID_curso = p_ID_curso AND ID_alumno = p_ID_alumno;
    END IF;
    
    IF p_Accion = 'DE' THEN
        DELETE FROM CursosUsuarios
        WHERE ID_curso = p_ID_curso AND ID_alumno = p_ID_alumno;
    END IF;
    IF p_Accion = 'SE' THEN
    SELECT
        vi.ID_curso,
        vi.Curso,
        vi.AlumnosInscritos,
        vi.NivelPromedio,
        vi.IngresosCurso,
        vi.ImagenCurso,
        (
            SELECT SUM(IngresosCurso)
            FROM viCursosUsuarios
        ) AS TotalVentas
    FROM viCursosUsuarios vi
    WHERE vi.Instructor = p_ID_instructor;
END IF;

IF p_Accion = 'SE2' THEN
    SELECT
       va.ID_curso,
        va.Curso,
        va.Alumno,
        va.FechaInscripcion,
        va.NivelAvance,
        va.PrecioPagado,
        va.FormaPago,
        va.PromedioCalificaciones
       
    FROM viDetalleAlumnos va
    ;
END IF;

IF p_Accion = 'SE3' THEN
   SELECT
        vk.ID_alumno,
        vk.ID_curso,
        vk.Curso,
        vk.Categoria,
        vk.Alumno,
        vk.FechaInscripcion,
        vk.FechaTerminacion,
        vk.Progreso,
        vk.ProgresoCurso,
        vk.EstadoCurso       
    FROM viKardex vk
    WHERE vk.ID_alumno = p_ID_alumno;
    
END IF;

END //

DELIMITER ;

