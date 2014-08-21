--
-- Estructura de tabla para la tabla tbl_rol
--

CREATE
  TABLE tbl_rol
  (
    id_rol      SMALLINT NOT NULL ,
    descripcion VARCHAR (45) ,
    CONSTRAINT tbl_rol_PK PRIMARY KEY CLUSTERED (id_rol)
  )
GO

CREATE
  TABLE tbl_rol_usuario
  (
    id_usuario VARCHAR (45) NOT NULL ,
    id_rol     SMALLINT NOT NULL ,
    CONSTRAINT tbl_rol_usuario_PK PRIMARY KEY CLUSTERED (id_usuario, id_rol)
  )
GO

CREATE
  TABLE tbl_usuarios
  (
    id_usuario VARCHAR (45) NOT NULL ,
    prnombre   VARCHAR (50) NOT NULL ,
    sgnombre   VARCHAR (50) ,
    prapellido VARCHAR (50) NOT NULL ,
    sgapellido VARCHAR (50) ,
    clave VARBINARY(50) NOT NULL ,
    fecha_creacion       DATETIME ,
    fecha_ultimo_ingreso DATETIME ,
    email                VARCHAR (100) ,
    CONSTRAINT tbl_usuarios_PK PRIMARY KEY CLUSTERED (id_usuario)
  )
GO

ALTER TABLE tbl_rol_usuario
ADD CONSTRAINT tbl_rol_usuario_tbl_rol_FK FOREIGN KEY
(
id_rol
)
REFERENCES tbl_rol
(
id_rol
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO

ALTER TABLE tbl_rol_usuario
ADD CONSTRAINT tbl_rol_usuario_tbl_usuarios_FK FOREIGN KEY
(
id_usuario
)
REFERENCES tbl_usuarios
(
id_usuario
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO


--
-- Volcado de datos para la tabla tbl_rol
--

INSERT INTO tbl_rol (id_rol, descripcion) VALUES
(1, 'Admin');
GO
INSERT INTO tbl_rol (id_rol, descripcion) VALUES
(2, 'TI');
GO
INSERT INTO tbl_rol (id_rol, descripcion) VALUES
(3, 'Contabilidad');
GO
-- --------------------------------------------------------

--
-- Volcado de datos para la tabla tbl_usuarios
--

INSERT INTO tbl_usuarios (id_usuario, prnombre, sgnombre, prapellido, sgapellido, clave, fecha_creacion, fecha_ultimo_ingreso, email) VALUES
('1', 'Osly', 'Jonathan', 'Salinas', 'Padilla', PWDENCRYPT('mapper'), '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'ojsalinas@ministerio.com');
GO
INSERT INTO tbl_usuarios (id_usuario, prnombre, sgnombre, prapellido, sgapellido, clave, fecha_creacion, fecha_ultimo_ingreso, email) VALUES
('2', 'Transito', 'Josue', 'Matamoros', 'Zuniga', PWDENCRYPT('transito'), '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'transito@ministerio.com');
GO
INSERT INTO tbl_usuarios (id_usuario, prnombre, sgnombre, prapellido, sgapellido, clave, fecha_creacion, fecha_ultimo_ingreso, email) VALUES
('3', 'Juan', 'Mekelele', 'Ramirez', 'Ruiz', PWDENCRYPT('juan'), '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'juan@ministerio.com');
GO
-- ------------------------------------------------------


--
-- Volcado de datos para la tabla tbl_rol_usuario
--

INSERT INTO tbl_rol_usuario (id_usuario, id_rol) VALUES
('1', 1);
GO
INSERT INTO tbl_rol_usuario (id_usuario, id_rol) VALUES
('2', 2);
GO
INSERT INTO tbl_rol_usuario (id_usuario, id_rol) VALUES
('3', 3);
GO
