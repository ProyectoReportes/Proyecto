--
-- Estructura de tabla para la tabla tbl_rol
--

CREATE TABLE  tbl_rol (
  id_rol smallint NOT NULL,
  descripcion varchar(45) NOT NULL,
  PRIMARY KEY (id_rol)
);
GO

--
-- Volcado de datos para la tabla tbl_rol
--

INSERT INTO tbl_rol (id_rol, descripcion) VALUES
(1, 'Admin'),
(2, 'TI'),
(3, 'Contabilidad');
GO
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tbl_usuarios
--

CREATE TABLE  tbl_usuarios (
  id_usuario varchar(45) NOT NULL,
  prnombre varchar(50) NOT NULL,
  sgnombre varchar(50)  NULL,
  prapellido varchar(50) NOT NULL,
  sgapellido varchar(50)  NULL,
  clave varbinary(30) NOT NULL,
  fecha_creacion datetime  NOT NULL,
  fecha_ultimo_ingreso datetime  NULL,
  email varchar(100)  NULL,
  PRIMARY KEY (id_usuario)
);
GO
--
-- Volcado de datos para la tabla tbl_usuarios
--

INSERT INTO tbl_usuarios (id_usuario, prnombre, sgnombre, prapellido, sgapellido, clave, fecha_creacion, fecha_ultimo_ingreso, email) VALUES
('1', 'Osly', 'Jonathan', 'Salinas', 'Padilla', 'mapper', '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'ojsalinas@ministerio.com'),
('2', 'Transito', 'Josue', 'Matamoros', 'Zuniga', 'transito', '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'transito@ministerio.com'),
('3', 'Juan', 'Mekelele', 'Ramirez', 'Ruiz', 'juan', '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'juan@ministerio.com');
GO
-- ------------------------------------------------------

--
-- Estructura de tabla para la tabla tbl_rol_usuario
--

CREATE TABLE  tbl_rol_usuario (
  id_usuario varchar(45) NOT NULL,
  id_rol smallint NOT NULL,
  PRIMARY KEY (id_usuario,id_rol)
);
GO

--
-- Volcado de datos para la tabla tbl_rol_usuario
--

INSERT INTO tbl_rol_usuario (id_usuario, id_rol) VALUES
('1', 1),
('2', 2),
('3', 3);
GO
-- --------------------------------------------------------
