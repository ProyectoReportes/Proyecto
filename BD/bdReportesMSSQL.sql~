-- Generado por Oracle SQL Developer Data Modeler 4.0.0.833
--   en:        2014-07-27 18:42:01 CST
--   sitio:      SQL Server 2000
--   tipo:      SQL Server 2000




CREATE DATABASE bdreportes;
USE bdreportes;

CREATE
  TABLE tbl_apchck
  (
    cchkno    VARCHAR (10) NOT NULL ,
    cvend     VARCHAR (10) NOT NULL ,
    cpayto    VARCHAR (40) NOT NULL ,
    cchktype  VARCHAR (1) NOT NULL ,
    cbankno   VARCHAR (10) NOT NULL ,
    ctogl     VARCHAR (10) NOT NULL ,
    dcheck    DATETIME NOT NULL ,
    dcreate   DATETIME NOT NULL ,
    lcancel   TINYINT NOT NULL ,
    lhold     TINYINT NOT NULL ,
    nchkamt   DECIMAL (16,2) NOT NULL ,
    nxchgrate DECIMAL (16,2) NOT NULL ,
    nbchkamt  DECIMAL (16,2) NOT NULL ,
    CONSTRAINT tbl_apchck_PK PRIMARY KEY CLUSTERED (cchkno)
  )
GO

CREATE
  TABLE tbl_departamento
  (
    id_departamento     INTEGER NOT NULL ,
    nombre_departamento VARCHAR (45) NOT NULL ,
    id_oficina          SMALLINT NOT NULL ,
    CONSTRAINT tbl_departamento_PK PRIMARY KEY CLUSTERED (id_departamento)
  )
GO

CREATE
  TABLE tbl_oficina
  (
    id_oficina SMALLINT NOT NULL ,
    direccion  VARCHAR (45) ,
    telefono   VARCHAR (45) ,
    id_region  SMALLINT NOT NULL ,
    CONSTRAINT tbl_oficina_PK PRIMARY KEY CLUSTERED (id_oficina),
    CONSTRAINT tbl_oficina_UK0 UNIQUE NONCLUSTERED (id_region)
  )
GO

CREATE
  TABLE tbl_region
  (
    id_region     SMALLINT NOT NULL ,
    nombre_region VARCHAR (45) NOT NULL ,
    CONSTRAINT tbl_region_PK PRIMARY KEY CLUSTERED (id_region)
  )
GO

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
    id_usuario           VARCHAR (45) NOT NULL ,
    prnombre             VARCHAR (50) NOT NULL ,
    sgnombre             VARCHAR (50) ,
    prapellido           VARCHAR (50) NOT NULL ,
    sgapellido           VARCHAR (50) ,
    clave                BINARY NOT NULL ,
    fecha_creacion       DATETIME ,
    fecha_ultimo_ingreso DATETIME ,
    email                VARCHAR (100) ,
    id_departamento      INTEGER NOT NULL ,
    CONSTRAINT tbl_usuarios_PK PRIMARY KEY CLUSTERED (id_usuario),
    CONSTRAINT tbl_usuarios_UK0 UNIQUE NONCLUSTERED (id_usuario)
  )
GO

ALTER TABLE tbl_departamento
ADD CONSTRAINT tbl_departamento_tbl_oficina_FK FOREIGN KEY
(
id_oficina
)
REFERENCES tbl_oficina
(
id_oficina
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO

ALTER TABLE tbl_oficina
ADD CONSTRAINT tbl_oficina_tbl_region_FK FOREIGN KEY
(
id_region
)
REFERENCES tbl_region
(
id_region
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
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

ALTER TABLE tbl_usuarios
ADD CONSTRAINT tbl_usuarios_tbl_departamento_FK FOREIGN KEY
(
id_departamento
)
REFERENCES tbl_departamento
(
id_departamento
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO


-- Informe de Resumen de Oracle SQL Developer Data Modeler: 
-- 
-- CREATE TABLE                             7
-- CREATE INDEX                             0
-- ALTER TABLE                              5
-- CREATE VIEW                              0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE DATABASE                          1
-- CREATE DEFAULT                           0
-- CREATE INDEX ON VIEW                     0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE ROLE                              0
-- CREATE RULE                              0
-- 
-- DROP DATABASE                            0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
