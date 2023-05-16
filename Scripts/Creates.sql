use bdm;



DROP TABLE IF EXISTS Cursos;
CREATE TABLE Cursos
(
ID_curso INT  NOT NULL, -- FK(Curso)
ID_usuario INT NOT NULL, -- FK(Usuario)
ID_usuario2 INT NOT NULL, -- FK(Usuario)
Progreso INT  NOT NULL,
IDDip INT NOT NULL, -- FK(Diploma	) 
Fecha DATE NOT NULL,
FechaF DATE NOT NULL,
PRIMARY KEY (ID_curso, ID_usuario,ID_usuario2)
);

DROP TABLE IF EXISTS Diploma;
CREATE TABLE Diploma
(
IDDip INT PRIMARY KEY NOT NULL,
Fecha DATE NOT NULL
);

DROP TABLE IF EXISTS Carrito;
CREATE TABLE Carrito
(
ID_ven INT NOT NULL, -- FK(Ventas)
ID_usuario INT NOT NULL, -- FK(usuario)
ID_curso INT NOT NULL, -- FK(usuario)
Total DECIMAL(10,2) NOT NULL,
PRIMARY KEY (ID_curso, ID_ven)
);

DROP TABLE IF EXISTS Ventas;
CREATE TABLE Ventas
(
ID_ven INT NOT NULL, 
ID_usuario INT NOT NULL, -- FK(usuario)
Fecha DATE NOT NULL,
Total DECIMAL(10,2) NOT NULL,
Pago DECIMAL(10,2) NOT NULL,
PRIMARY KEY (ID_usuario, ID_ven)
);

DROP TABLE IF EXISTS Comentarios;
CREATE TABLE Comentarios
(
ID_usuario INT NOT NULL, -- FK(usuario)
ID_curso INT NOT NULL, -- FK(Curso)
Favor VARCHAR(100)  NOT NULL, 
Calif DECIMAL(2,2) NOT NULL,
Fecha DATE NOT NULL,
Hora TIME NOT NULL,
PRIMARY KEY (ID_usuario, ID_curso)
);

DROP TABLE IF EXISTS Mensajes;
CREATE TABLE Mensajes
(
IDMen INT PRIMARY KEY NOT NULL, 
ID_usuario INT NOT NULL, -- FK(Usuario)
ID_usuario2 INT NOT NULL, -- FK(Usuario)
Mensaje VARCHAR(100)  NOT NULL, 
Fecha DATE NOT NULL,
Hora TIME NOT NULL
);

DROP TABLE IF EXISTS Niveles;
CREATE TABLE Niveles
(
IDNiv INT  NOT NULL, 
ID_curso INT  NOT NULL, -- FK(Curso) 
Video LONGBLOB NOT NULL,
Premium BOOL NOT NULL,
 PRIMARY KEY (IDNiv, ID_curso)
);

DROP TABLE IF EXISTS Curso;
CREATE TABLE Curso
(
ID_curso INT PRIMARY KEY NOT NULL, -- PK 
Niveles INT NOT NULL,
Costo DECIMAL(10,2) NOT NULL,
Titulo VARCHAR(30) NOT NULL,
Descripcion VARCHAR(50) NOT NULL,
Promedio DECIMAL(2,2) NOT NULL,
Imagen BLOB NOT NULL,
Diploma BLOB NOT NULL,
Gratis BOOL NOT NULL,
Eliminado BOOL NOT NULL,
Progreso INT NOT NULL,
IDMulti INT NOT NULL, -- FK(Multimedia) 
IDCat INT NOT NULL, -- FK(Categoria)
curel BOOL NOT NULL 
);

DROP TABLE IF EXISTS Usuarios;
CREATE TABLE Usuarios
(
ID_usuario INT auto_increment PRIMARY KEY NOT NULL, -- PK 
Usuario VARCHAR(30) NOT NULL unique,
Nombre VARCHAR(30) NOT NULL,
Ap VARCHAR(30) NOT NULL,
Am VARCHAR(30) NOT NULL,
Pass VARCHAR(30) NOT NULL, 
Rol INT NOT NULL,
Imagen LONGBLOB NOT NULL,
Genero BOOLEAN NOT NULL,
Fecha DATE NOT NULL,
Fechan DATE NOT NULL,
Correo VARCHAR(30) NOT NULL,
err INT NOT NULL,
usel BOOL NOT NULL
);

DROP TABLE IF EXISTS Multimedia;
CREATE TABLE Multimedia
(
IDMulti INT PRIMARY KEY NOT NULL, -- PK 
Multimedia BLOB NOT NULL,
mulel BOOL NOT NULL
);

DROP TABLE IF EXISTS Categoria;
CREATE TABLE Categoria
(
IDCat INT PRIMARY KEY NOT NULL, -- PK 
Categoria VARCHAR(30) NOT NULL,
Descripcion VARCHAR(50) NOT NULL,
catel BOOL NOT NULL
);

ALTER TABLE curso
	ADD CONSTRAINT FK_Curso_IDMulti  FOREIGN KEY (IDMulti) REFERENCES Multimedia(IDMulti),
	ADD CONSTRAINT FK_Curso_IDCat  FOREIGN KEY (IDCat) REFERENCES categoria(IDCat);
    
    ALTER TABLE niveles
	ADD CONSTRAINT FK_Curso_IDcur  FOREIGN KEY (ID_curso) REFERENCES curso(ID_curso);
    
    ALTER TABLE mensajes
	ADD CONSTRAINT FK_Curso_IDUs  FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario),
	ADD CONSTRAINT FK_Curso_IDUs2  FOREIGN KEY (ID_usuario2) REFERENCES usuarios(ID_usuario);
    
    ALTER TABLE comentarios
	ADD CONSTRAINT FK_Curso_IDUss  FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario),
	ADD CONSTRAINT FK_Curso_IDCur2  FOREIGN KEY (ID_curso) REFERENCES curso(ID_curso);
    
    ALTER TABLE carrito
	ADD CONSTRAINT FK_Curso_IDven  FOREIGN KEY (ID_usuario,ID_ven) REFERENCES ventas(ID_usuario, ID_ven),
	ADD CONSTRAINT FK_Curso_IDCur3  FOREIGN KEY (ID_curso) REFERENCES curso(ID_curso);
    
     ALTER TABLE ventas
	ADD CONSTRAINT FK_Curso_IDUsss  FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario);
    
    ALTER TABLE cursos
	ADD CONSTRAINT FK_Curso_IDcur4 FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario),
	ADD CONSTRAINT FK_Curso_IDCur5  FOREIGN KEY (ID_usuario2) REFERENCES usuarios(ID_usuario),
    ADD CONSTRAINT FK_Curso_IDCur6  FOREIGN KEY (ID_curso) REFERENCES curso(ID_curso),
    ADD CONSTRAINT FK_Curso_IDCur7  FOREIGN KEY (IDDip) REFERENCES Diploma(IDDip);
    
     
    
    