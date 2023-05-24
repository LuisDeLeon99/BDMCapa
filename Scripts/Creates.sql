use bdm;

DROP TABLE IF EXISTS CursosUsuarios;
CREATE TABLE CursosUsuarios
(
ID_curso INT  NOT NULL, -- FK(Curso)
ID_alumno INT NOT NULL, -- FK(Usuario)
ID_instructor INT NOT NULL, -- FK(Usuario)
Progreso INT  NOT NULL,
Diploma BLOB NOT NULL, 
Fecha DATE NOT NULL,
FechaF DATE NOT NULL,
PRIMARY KEY (ID_curso, ID_alumno)
);


DROP TABLE IF EXISTS DetalleVentas;
CREATE TABLE DetalleVentas
(
  ID_detalle int primary key auto_increment,
  ID_Ventas INT NOT NULL, -- FK(Ventas)
  ID_curso INT NOT NULL, -- FK(Curso)
  Cantidad INT NOT NULL,
  PrecioUnitario DECIMAL(10,2) NOT NULL,
  Subtotal DECIMAL(10,2) NOT NULL  
);

DROP TABLE IF EXISTS Ventas;
CREATE TABLE Ventas
(
ID_ventas INT primary key auto_increment, 
ID_usuario INT NOT NULL, -- FK(usuario)
Fecha DATE NOT NULL,
Total DECIMAL(10,2) NOT NULL,
Pago DECIMAL(10,2) NOT NULL,
Metodo int not null -- FK(pago)

);

DROP TABLE IF EXISTS Pago;
CREATE TABLE Pago
(
  ID_pago int primary key auto_increment,
  Descripcion INT NOT NULL
 
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
IDMen INT PRIMARY KEY auto_increment, 
ID_alumno INT NOT NULL, -- FK(Usuario)
ID_instructor INT NOT NULL, -- FK(Usuario)
Mensaje VARCHAR(100)  NOT NULL, 
Fecha DATE NOT NULL,
Hora TIME NOT NULL
);

DROP TABLE IF EXISTS Niveles;
CREATE TABLE Niveles
(
IDNiv INT  PRIMARY KEY auto_increment, 
ID_curso INT  NOT NULL, -- FK(Curso)
Nivel INT NOT NUll,
Video LONGBLOB NOT NULL,
Premium BOOL NOT NULL
);





DROP TABLE IF EXISTS Multimedia;
CREATE TABLE Multimedia
(
IDMulti INT PRIMARY KEY NOT NULL, -- PK 
Descripcion VARCHAR(30),
Multimedia LONGBLOB NOT NULL,
Multimedia2 BLOB NOT NULL,
mulel BOOL NOT NULL,
 ID_curso INT NOT NULL -- FK(Curso)
);

DROP TABLE IF EXISTS Curso;
CREATE TABLE Curso
(
ID_curso INT PRIMARY KEY NOT NULL, -- PK 
Niveles INT NOT NULL,
Costo DECIMAL(10,2) NOT NULL,
Titulo VARCHAR(30) NOT NULL,
Descripcion VARCHAR(50) NOT NULL,
Imagen BLOB NOT NULL,
Diploma BLOB NOT NULL,
Gratis BOOL NOT NULL,
Eliminado BOOL NOT NULL,
IDCat INT NOT NULL -- FK(Categoria)
);

DROP TABLE IF EXISTS Categoria;
CREATE TABLE Categoria
(
IDCat INT PRIMARY KEY auto_increment, -- PK 
ID_usuario int, -- FK(usuario)
Categoria VARCHAR(30) NOT NULL,
Descripcion VARCHAR(50) NOT NULL,
creacion date NOT NULL ,
catel BOOL NOT NULL
);

DROP TABLE IF EXISTS Usuarios;
CREATE TABLE Usuarios
(
ID_usuario INT auto_increment PRIMARY KEY NOT NULL, -- PK 
Usuario VARCHAR(30) NOT NULL unique,
Nombre VARCHAR(30) NOT NULL,
Apaterno VARCHAR(30) NOT NULL,
Amaterno VARCHAR(30) NOT NULL,
Pass VARCHAR(30) NOT NULL, 
Rol INT NOT NULL, -- 0 admin, 1 alumno, 2 instructor
Imagen LONGBLOB NOT NULL,
Genero BOOLEAN NOT NULL, -- 0 masc, 1 fem 
Fecha DATE NOT NULL,
Fechan DATE NOT NULL,
Correo VARCHAR(30) NOT NULL,
err INT NOT NULL,
usel BOOL NOT NULL
);

ALTER TABLE Curso	
	ADD CONSTRAINT FK_Curso_IDCat  FOREIGN KEY (IDCat) REFERENCES categoria(IDCat);
    
    ALTER TABLE niveles
	ADD CONSTRAINT FK_Curso_IDcur  FOREIGN KEY (ID_curso) REFERENCES Curso(ID_curso);
    
    ALTER TABLE mensajes
	ADD CONSTRAINT FK_Curso_IDUs  FOREIGN KEY (ID_alumno) REFERENCES usuarios(ID_usuario),
	ADD CONSTRAINT FK_Curso_IDUs2  FOREIGN KEY (ID_instructor) REFERENCES usuarios(ID_usuario);
    
    ALTER TABLE comentarios
	ADD CONSTRAINT FK_Curso_IDUss  FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario),
	ADD CONSTRAINT FK_Curso_IDCur2  FOREIGN KEY (ID_curso) REFERENCES Curso(ID_curso);
    
     ALTER TABLE DetalleVentas
 	 ADD CONSTRAINT FK_Curso_IDven  FOREIGN KEY (ID_ventas) REFERENCES ventas(ID_ventas),
	 ADD CONSTRAINT FK_Curso_IDCur3  FOREIGN KEY (ID_curso) REFERENCES curso(ID_curso);
    
     ALTER TABLE ventas	
    ADD CONSTRAINT FK_Curso_IDUsg 	FOREIGN KEY (ID_usuario) REFERENCES Usuarios(ID_usuario),
    ADD CONSTRAINT FK_Curso_IDgt  FOREIGN KEY (Metodo) REFERENCES Pago(ID_pago);
    
    ALTER TABLE CursosUsuarios
	ADD CONSTRAINT FK_Curso_IDUs7 FOREIGN KEY (ID_instructor) REFERENCES usuarios(ID_usuario),
	ADD CONSTRAINT FK_Curso_IDU6s FOREIGN KEY (ID_curso) REFERENCES Curso(ID_curso),
    ADD CONSTRAINT FK_Curso_IDU6fs FOREIGN KEY (ID_alumno) REFERENCES usuarios(ID_usuario);	
    
    ALTER TABLE Multimedia	
	ADD CONSTRAINT FK_Curso_IDCatgt  FOREIGN KEY (ID_curso) REFERENCES Curso(ID_curso);
    
    ALTER TABLE Categoria	
	ADD CONSTRAINT FK_Curso_IDCatg  FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario);
    
    
     
    
    