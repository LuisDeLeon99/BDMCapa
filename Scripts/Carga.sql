use bdm;

INSERT INTO Pago (Descripcion) VALUES
('Tarjeta de crédito'),
('Tarjeta de débito'),
('Transferencia bancaria'),
('PayPal'),
('Criptomoneda');

INSERT INTO Usuarios (Usuario, Nombre, Apaterno, Amaterno, Pass, Rol, Imagen, Genero, Fecha, Fechan, Correo, err, usel) VALUES
('admin', 'Administrador', '', '', 'Admin1234.', 0, '', 0, CURDATE(), CURDATE(), 'admin@gmail.com', 0, 0);

INSERT INTO Categoria (ID_usuario, Categoria, Descripcion, creacion, catel) VALUES
(1, 'Curso Online', 'Categoría para cursos en línea', CURDATE(), 0);