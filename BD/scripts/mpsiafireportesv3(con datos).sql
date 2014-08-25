﻿USE [mpsiafireportes]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Emil Ordoñez>
-- Create date: <2014-08-19>
-- Description:	<Reporte Presupuestario por Programa>
-- =============================================
CREATE PROCEDURE [sp_reporte_presupuesto_programa]

AS
BEGIN
	
	SET NOCOUNT ON;

	SELECT SUBSTRING(budget.cbudno,5,3) AS PROGRAMA ,budget.cbudid AS PRESUPUESTO,
			(SUM(budget.namtmod) - SUM(budget.namt)) AS TRANSFERENCIA,
			SUM(budget.namtmod) AS MODIFICADO, SUM(budget.namtused) AS UTILIZADO,
			SUM(budget.namtmod - budget.namtused) AS DISPONIBLE,
			(SUM(budget.namtused) / SUM(budget.namtmod)) AS '% UTILIZADO',
			((SUM(budget.namtmod) - SUM(budget.namtused)) / SUM(budget.namtmod)) AS '% DISPONIBLE'
		FROM mpsiafi.dbo.bgbudt AS budget
		WHERE SUBSTRING(budget.cbudid,5,4) = YEAR(GETDATE())
		GROUP BY SUBSTRING(budget.cbudno,5,3), budget.cbudid
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Emil Ordoñez>
-- Create date: <2014-08-19>
-- Description:	<Reporte Presupuestario por Programa>
-- =============================================
CREATE PROCEDURE [sp_reporte_presupuesto_grupo]

AS
BEGIN
	
	SET NOCOUNT ON;

	SELECT SUBSTRING(budget.cbudno,17,1) AS GRUPO ,budget.cbudid AS PRESUPUESTO,
			(SUM(budget.namtmod) - SUM(budget.namt)) AS TRANSFERENCIA,
			SUM(budget.namtmod) AS MODIFICADO, SUM(budget.namtused) AS UTILIZADO,
			SUM(budget.namtmod - budget.namtused) AS DISPONIBLE,
			(SUM(budget.namtused) / SUM(budget.namtmod)) AS '% UTILIZADO',
			((SUM(budget.namtmod) - SUM(budget.namtused)) / SUM(budget.namtmod)) AS '% DISPONIBLE'
		FROM mpsiafi.dbo.bgbudt AS budget
		WHERE SUBSTRING(budget.cbudid,5,4) = YEAR(GETDATE())
		GROUP BY SUBSTRING(budget.cbudno,17,1), budget.cbudid
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE  PROCEDURE [sp_reporte_presupuesto_subgrupo]
AS
BEGIN
SELECT SUBSTRING(budget.cbudno,17,2) AS "SUB GRUPO", 
	  (budget.cbudid) AS "PRESUPUESTO", 
	  (SUM(budget.namtmod) - SUM(budget.namt)) AS "TRANSFERENCIA", 
	   SUM(budget.namtmod) AS "MODIFICADO",
	   SUM(budget.namtused) AS "UTILIZADO", 
	  (SUM(budget.namtmod) - SUM(budget.namtused)) AS "DISPONIBLE",
	  (SUM(budget.namtused) / SUM(budget.namtmod)) AS "% UTILIZADO", 
	  ((SUM(budget.namtmod) - SUM(budget.namtused)) / SUM(budget.namtmod)) AS "% DISPONIBLE"
FROM mpsiafi.dbo.bgbudt as budget 
WHERE SUBSTRING(budget.cbudid,5,4) = YEAR(GETDATE())
GROUP BY SUBSTRING(budget.cbudno,17,2), budget.cbudid;
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_reporte_deducciones_empleados]

AS
BEGIN
	
	SET NOCOUNT ON;
	
	SELECT empl.cempno AS '# EMPLEADO',empl.cfedid AS 'IDENTIDAD',
		empl.cfname AS NOMBRES, empl.clname AS APELLIDOS,
		jobs.cDesc AS CARGO,
		dept.cdeptname AS 'DEPARTAMENTO', misd.cpayno AS PLANILLA,
		misd.cdedno AS 'COD. DED.', misd.cdesc AS DESCRIPCION,
		misd.ndedamt AS 'VALOR DED.'
		FROM mpsiafi.dbo.prempy AS empl
			INNER JOIN mpsiafi.dbo.HRJobs AS jobs
				ON empl.cjobtitle = jobs.cJobTitlNO
			INNER JOIN mpsiafi.dbo.prdept AS dept
				ON empl.cdeptno = dept.cdeptno
			INNER JOIN mpsiafi.dbo.prmisd AS misd
				ON empl.cempno = misd.cempno
	
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_reporte_ingreso_empleados]
AS
BEGIN
SET NOCOUNT ON;
	SELECT E.cempno AS "CODIGO", E.cfedid AS "IDENTIDAD", E.cfname AS "NOMBRES", E.clname AS "APELLIDOS", J.cDesc AS "CARGO", 
	D.cdeptname AS "DEPARTAMENTO", M.cref AS "REFERENCIA", M.cbankno AS "BANCO", M.cchkno AS "CHEQUE", M.cpayno AS "PLANILLA", M.cpaycode AS "COD. INGR.", 
	(M.nqty*M.nrate) AS "VALOR INGR." 
	FROM mpsiafi.dbo.prempy AS E, mpsiafi.dbo.prmisc AS M, mpsiafi.dbo.prdept AS D, mpsiafi.dbo.HrJobs AS J 
	WHERE E.cdeptno = D.cdeptno  AND E.cjobtitle = J.cJobTitlNO AND E.cempno = M.cempno 
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Emil Ordoñez>
-- Create date: <2014-08-19>
-- Description:	<Reporte Presupuestario por Programa>
-- =============================================
CREATE PROCEDURE [sp_reporte_presupuesto_compara]

AS
BEGIN
	
	SET NOCOUNT ON;

	SELECT budget.cbudno AS CUENTA ,budget.cbudid AS PRESUPUESTO,
			(budget.namt) AS ORIGINAL,
			(budget.namtmod) AS MODIFICADO, (budget.namtused) AS UTILIZADO,
			(budget.namtmod - budget.namtused) AS DISPONIBLE,
			((budget.namtused) / (budget.namtmod)) AS '% UTILIZADO',
			(((budget.namtmod) - (budget.namtused)) / (budget.namtmod)) AS '% DISPONIBLE'
		FROM mpsiafi.dbo.bgbudt AS budget
		WHERE SUBSTRING(budget.cbudid,5,4) = YEAR(GETDATE())
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_reporte_presupuesto_transacciones]

AS
BEGIN
	
	SET NOCOUNT ON;

	((SELECT 'TRANS.' AS TIPO,CONVERT(VARCHAR,trn.cfbudno) AS DESDE,
		trn.ctbudno AS HASTA, trn.ntrfamt AS 'CANTIDAD',
		trn.tmodrec AS FECHA
		FROM mpsiafi.dbo.bgtrfm AS trn
		WHERE YEAR(trn.tmodrec) = YEAR(GETDATE())
	)
	UNION
	(SELECT 'AJUST.' AS TIPO,'N/A' AS DESDE,
		aju.cbudno AS HASTA, aju.nadjamt AS 'CANTIDAD',
		aju.tmodrec AS FECHA
		FROM mpsiafi.dbo.bgadjm AS aju
		WHERE YEAR(aju.tmodrec) = YEAR(GETDATE())
	))ORDER BY FECHA
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [tbl_usuarios](
	[id_usuario] [varchar](45) NOT NULL,
	[prnombre] [varchar](50) NOT NULL,
	[sgnombre] [varchar](50) NULL,
	[prapellido] [varchar](50) NOT NULL,
	[sgapellido] [varchar](50) NULL,
	[clave] [varbinary](50) NOT NULL,
	[fecha_creacion] [datetime] NULL,
	[fecha_ultimo_ingreso] [datetime] NULL,
	[email] [varchar](100) NOT NULL,
 CONSTRAINT [tbl_usuarios_PK] PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC
) ON [PRIMARY],
 CONSTRAINT [UQ_tbl_usuarios] UNIQUE NONCLUSTERED 
(
	[id_usuario] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
INSERT [tbl_usuarios] ([id_usuario], [prnombre], [sgnombre], [prapellido], [sgapellido], [clave], [fecha_creacion], [fecha_ultimo_ingreso], [email]) VALUES (CONVERT(TEXT, N'007'), CONVERT(TEXT, N'Edson'), NULL, CONVERT(TEXT, N'Bonilla'), NULL, 0x0100512AC046390DF84F8682FFEDBED75188B23BC256E9828DAB390DF84F8682FFEDBED75188B23BC256E9828DAB, CAST(0x0000A3900133C160 AS DateTime), CAST(0x0000A39001594BDA AS DateTime), CONVERT(TEXT, N'edson@ministerio.com'))
INSERT [tbl_usuarios] ([id_usuario], [prnombre], [sgnombre], [prapellido], [sgapellido], [clave], [fecha_creacion], [fecha_ultimo_ingreso], [email]) VALUES (CONVERT(TEXT, N'1'), CONVERT(TEXT, N'Osly'), CONVERT(TEXT, N'Jonathan'), CONVERT(TEXT, N'Salinas'), CONVERT(TEXT, N'Padilla'), 0x010039037E39B2C69FBDF0751E0502F047B9D624A6F2515875B16B2DD2B3B03E4A082B5CF914944F9973CDDA4E26, CAST(0x0000A2AD00000000 AS DateTime), CAST(0x0000A3900140AD0C AS DateTime), CONVERT(TEXT, N'ojsalinas@ministerio.com'))
INSERT [tbl_usuarios] ([id_usuario], [prnombre], [sgnombre], [prapellido], [sgapellido], [clave], [fecha_creacion], [fecha_ultimo_ingreso], [email]) VALUES (CONVERT(TEXT, N'3'), CONVERT(TEXT, N'Juan'), CONVERT(TEXT, N'Mekelele'), CONVERT(TEXT, N'Ramirez'), CONVERT(TEXT, N'Ruiz'), 0x01005F765F1317BB4C7DBC3428CB871C51591F9EC07F37CD1BD01D9D0F4B21267EB03945BC8B810686D11C980A91, CAST(0x0000A2AD00000000 AS DateTime), CAST(0x0000A390015E538A AS DateTime), CONVERT(TEXT, N'juan@ministerio.com'))
INSERT [tbl_usuarios] ([id_usuario], [prnombre], [sgnombre], [prapellido], [sgapellido], [clave], [fecha_creacion], [fecha_ultimo_ingreso], [email]) VALUES (CONVERT(TEXT, N'eavila'), CONVERT(TEXT, N'Emil'), NULL, CONVERT(TEXT, N'OrdoÃ±ez'), NULL, 0x0100FB5869412F8246B7B4720D24ED11CDD1B79806C66FC2EA8226359409A2C0C64A7C09A36A008CE9781FAAF1F7, CAST(0x0000A38F004E9669 AS DateTime), CAST(0x0000A39101009152 AS DateTime), CONVERT(TEXT, N'eavila@mp.com'))
INSERT [tbl_usuarios] ([id_usuario], [prnombre], [sgnombre], [prapellido], [sgapellido], [clave], [fecha_creacion], [fecha_ultimo_ingreso], [email]) VALUES (CONVERT(TEXT, N'Sindeee'), CONVERT(TEXT, N'Sindy'), NULL, CONVERT(TEXT, N'Garcia'), NULL, 0x0100FA4AD32CC9C729D44765C850CFCBE317C07A8185DA68C46182E85BAE9D8EB19EED6F8382FBA9A6A264B758A3, CAST(0x0000A38F00498FA8 AS DateTime), NULL, CONVERT(TEXT, N'sgarcia@ministerio.com'))
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [tbl_rol](
	[id_rol] [smallint] NOT NULL,
	[descripcion] [varchar](45) NULL,
 CONSTRAINT [tbl_rol_PK] PRIMARY KEY CLUSTERED 
(
	[id_rol] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
INSERT [tbl_rol] ([id_rol], [descripcion]) VALUES (1, CONVERT(TEXT, N'Admin'))
INSERT [tbl_rol] ([id_rol], [descripcion]) VALUES (2, CONVERT(TEXT, N'TI'))
INSERT [tbl_rol] ([id_rol], [descripcion]) VALUES (3, CONVERT(TEXT, N'Gerencia'))
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_reporte_empl_cuentas_presupuestarias]
	@cargo VARCHAR(40)='', @depto VARCHAR(30)='',@codpres VARCHAR(30)='',
	@est VARCHAR(2)='',@fcontrIn DATETIME=NULL,@fcontrFn DATETIME=NULL,
	@facrdIn DATETIME=NULL,@facrdFn DATETIME=NULL
	AS
BEGIN 
	SET NOCOUNT ON;
	IF @facrdIn='' BEGIN
		SET @facrdIn = '19000101'
	END
	IF @facrdFn='' BEGIN
		SET @facrdFn = '29000101'
	END
	IF @fcontrIn='' BEGIN
		SET @fcontrIn = '19000101'
	END
	IF @fcontrFn='' BEGIN
		SET @fcontrFn = '29000101'
	END

	SELECT empy.cempno AS CODIGO, empy.cfedid AS ID, 
			empy.cfname AS NOMBRES,
			empy.clname AS APELLIDOS, empy.csex AS SEXO,
			empy.dbirth AS NACIMIENTO, 
			dept.cdeptname AS 'DEPARTAMENTO', jobs.cDesc AS CARGO, 
			empy.nmonthpay AS SALARIO, empy.dcntrct AS 'F. CONTRATO',
			empy.dhire AS 'F. ACUERDO',
			empy.ctaxstate, empy.cpaytype AS 'T. PLANILLA',
			empy.cstate AS ESTADO, empg.cwageacc AS 'COD. PRES'
		FROM mpsiafi.dbo.prempy AS empy, mpsiafi.dbo.HRJobs AS jobs,
			mpsiafi.dbo.prdept AS dept, mpsiafi.dbo.prempg AS empg
		WHERE empy.cdeptno = dept.cdeptno
			AND empy.cjobtitle = jobs.cJobTitlNO 
			AND empy.cempno = empg.cempno
			AND dhire BETWEEN ISNULL(@facrdIn,'19000101') 
						AND ISNULL(@facrdFn, '29001231')
			AND dcntrct BETWEEN ISNULL(@fcontrIn,'19000101') 
						AND ISNULL(@fcontrFn, '29001231')
			AND jobs.cDesc LIKE '%'+ ISNULL(@cargo,'') +'%' 
			AND dept.cdeptname LIKE '%'+ ISNULL(@depto,'') +'%'
			AND empg.cwageacc LIKE '%'+ ISNULL(@codpres,'') +'%' 
			AND empy.cstate LIKE '%'+ ISNULL(@est,'') +'%'		
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [tbl_apchck](
	[cvendno] [char](10) NOT NULL,
	[cpayto] [char](40) NOT NULL,
	[cchktype] [char](1) NOT NULL,
	[cbankno] [char](10) NOT NULL,
	[cchkno] [char](10) NOT NULL,
	[ctogl] [char](1) NOT NULL,
	[dcheck] [datetime] NOT NULL,
	[dcreate] [datetime] NOT NULL,
	[lcancel] [smallint] NOT NULL,
	[lhold] [smallint] NOT NULL,
	[nchkamt] [numeric](16, 2) NOT NULL,
	[nfchkamt] [numeric](16, 2) NOT NULL,
	[nxchgrate] [numeric](16, 6) NOT NULL,
	[nbchkamt] [numeric](16, 2) NOT NULL,
	[centregado] [char](1) NULL,
 CONSTRAINT [tbl_apchck_PK] PRIMARY KEY CLUSTERED 
(
	[cchkno] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [tbl_accchk](
	[namt] [numeric](16, 2) NOT NULL,
	[dfechamod] [datetime] NULL,
	[cdesc] [varchar](200) NULL
) ON [PRIMARY]
GO
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(15000.00 AS Numeric(16, 2)), CAST(0x0000A3900127FF6F AS DateTime), CONVERT(TEXT, N'Inicio de Periodo Anual de Presupuesto'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(200000.00 AS Numeric(16, 2)), CAST(0x0000A39100F9CA0C AS DateTime), CONVERT(TEXT, N'sdfsdf'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(15000.00 AS Numeric(16, 2)), CAST(0x0000A39100FB1285 AS DateTime), CONVERT(TEXT, N'ActualizaciÃ³n ConciliaciÃ³n'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(15000.00 AS Numeric(16, 2)), CAST(0x0000A39100FB1285 AS DateTime), CONVERT(TEXT, N'ActualizaciÃ³n ConciliaciÃ³n'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(15995.00 AS Numeric(16, 2)), CAST(0x0000A39101016E04 AS DateTime), CONVERT(TEXT, N'Actualizacion'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(15995.00 AS Numeric(16, 2)), CAST(0x0000A39101016E04 AS DateTime), CONVERT(TEXT, N'Actualizacion'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(12000.00 AS Numeric(16, 2)), CAST(0x0000A391010322D0 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(12000.00 AS Numeric(16, 2)), CAST(0x0000A391010322D0 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(14400.00 AS Numeric(16, 2)), CAST(0x0000A3910103C4E6 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva2'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(14400.00 AS Numeric(16, 2)), CAST(0x0000A3910103C4E6 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva2'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(160000.00 AS Numeric(16, 2)), CAST(0x0000A3910103EA20 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva3'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(160000.00 AS Numeric(16, 2)), CAST(0x0000A3910103EA20 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva3'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(20000.00 AS Numeric(16, 2)), CAST(0x0000A39101044047 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva4'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(20000.00 AS Numeric(16, 2)), CAST(0x0000A39101044047 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva4'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(16000.00 AS Numeric(16, 2)), CAST(0x0000A39101010051 AS DateTime), CONVERT(TEXT, N'Actualizacion'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(16000.00 AS Numeric(16, 2)), CAST(0x0000A39101010276 AS DateTime), CONVERT(TEXT, N'Actualizacion'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(160000.00 AS Numeric(16, 2)), CAST(0x0000A3910103E570 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva3'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(160000.00 AS Numeric(16, 2)), CAST(0x0000A3910103E570 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva3'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(20000.00 AS Numeric(16, 2)), CAST(0x0000A391010423C4 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva4'))
INSERT [tbl_accchk] ([namt], [dfechamod], [cdesc]) VALUES (CAST(20000.00 AS Numeric(16, 2)), CAST(0x0000A39101042573 AS DateTime), CONVERT(TEXT, N'Actualizacion Nueva4'))
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [tbl_rol_usuario](
	[id_usuario] [varchar](45) NOT NULL,
	[id_rol] [smallint] NOT NULL,
 CONSTRAINT [tbl_rol_usuario_PK] PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC,
	[id_rol] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
INSERT [tbl_rol_usuario] ([id_usuario], [id_rol]) VALUES (CONVERT(TEXT, N'007'), 1)
INSERT [tbl_rol_usuario] ([id_usuario], [id_rol]) VALUES (CONVERT(TEXT, N'1'), 1)
INSERT [tbl_rol_usuario] ([id_usuario], [id_rol]) VALUES (CONVERT(TEXT, N'3'), 3)
INSERT [tbl_rol_usuario] ([id_usuario], [id_rol]) VALUES (CONVERT(TEXT, N'eavila'), 1)
INSERT [tbl_rol_usuario] ([id_usuario], [id_rol]) VALUES (CONVERT(TEXT, N'Sindeee'), 3)
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_login]
	@correo VARCHAR(100),@clave VARCHAR(50)
AS
BEGIN
	
	SET NOCOUNT ON;

	SELECT TOP 1 (usr.prnombre + ' ' + usr.prapellido + ' - ' + rol.descripcion) AS NOMBRE, rol.id_rol AS ROL 
		FROM mpsiafireportes.dbo.tbl_usuarios AS usr
			INNER JOIN mpsiafireportes.dbo.tbl_rol_usuario AS rolusr
				ON usr.id_usuario = rolusr.id_usuario
			INNER JOIN mpsiafireportes.dbo.tbl_rol AS rol
				ON rol.id_rol = rolusr.id_rol
		WHERE usr.email = @correo AND PWDCOMPARE(@clave,usr.clave)=1
		
	
	UPDATE mpsiafireportes.dbo.tbl_usuarios
		SET fecha_ultimo_ingreso = GETDATE()
		WHERE email = @correo
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_getroles]
	
AS
BEGIN
	SET NOCOUNT ON;

    SELECT r.id_rol AS ROL,r.descripcion AS 'DESC'
		FROM tbl_rol AS r
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_eliminausuario]
	@correo VARCHAR(100)
AS
BEGIN
	
	SET NOCOUNT ON;
	DELETE FROM tbl_rol_usuario
		WHERE id_usuario IN (SELECT id_usuario FROM tbl_usuarios WHERE email=@correo)

	DELETE FROM tbl_usuarios
		WHERE email = @correo
	
	RETURN @@ERROR;
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_nuevousuario]
	@idusuario VARCHAR(45),@correo VARCHAR(100),
	@prnombre VARCHAR(50),
	@prapellido VARCHAR(50),
	@clave VARCHAR(50)=NULL,@rol TINYINT=3
AS
BEGIN
	
    -- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

		INSERT INTO tbl_usuarios (id_usuario,email,prnombre,
				prapellido,clave,fecha_creacion)
			VALUES(@idusuario,@correo,@prnombre,
				@prapellido,
				PWDENCRYPT(ISNULL(@clave,'123456')),GETDATE())
		
		INSERT INTO tbl_rol_usuario (id_usuario,id_rol)
			VALUES (@idusuario,@rol)			
		
	
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_reiniciaclave]
	@correo VARCHAR(100),@clave VARCHAR(50)='123456'
AS
BEGIN
	
	SET NOCOUNT ON;

	UPDATE tbl_usuarios
		SET clave = PWDENCRYPT(@clave)
		WHERE email=@correo;
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_getusuarios]
	@id VARCHAR(45)='',@correo VARCHAR(100)=''
AS
BEGIN
	SET NOCOUNT ON;
	SELECT u.email AS CORREO,u.id_usuario AS ID
		FROM tbl_usuarios AS u
		WHERE u.email LIKE '%' + @correo + '%'
			AND u.id_usuario LIKE '%' + @id + '%'
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_chk_actualizar]

AS
BEGIN
	
	SET NOCOUNT ON;

	INSERT INTO mpsiafireportes.dbo.tbl_apchck(cvendno, cpayto, cchktype, 
			cbankno, cchkno, ctogl, dcheck, dcreate, lcancel, lhold, 
			nchkamt, nfchkamt, nxchgrate, nbchkamt)
		(SELECT mpchk.cvendno, mpchk.cpayto, mpchk.cchktype, mpchk.cbankno, 
				mpchk.cchkno, mpchk.ctogl, mpchk.dcheck, mpchk.dcreate,
				mpchk.lcancel, mpchk.lhold, mpchk.nchkamt, mpchk.nfchkamt,
				mpchk.nxchgrate, mpchk.nbchkamt 
				FROM mpsiafi.dbo.apchck AS mpchk
				WHERE mpchk.cchkno NOT IN
					(SELECT  mprchk.cchkno 
						FROM mpsiafireportes.dbo.tbl_apchck AS mprchk))

	DECLARE cheques CURSOR FOR
		SELECT tchk.cchkno
			FROM mpsiafireportes.dbo.tbl_apchck AS tchk
			--WHERE centregado=0;

	-- Apertura del cursor

	OPEN cheques

	-- Lectura de la primera fila del cursor
	DECLARE @num_chk VARCHAR(10);	
	DECLARE @nuevo_lcancel SMALLINT;
	DECLARE @nuevo_lhold SMALLINT;

	FETCH cheques INTO @num_chk;

 	WHILE (@@FETCH_STATUS = 0 ) BEGIN
		--SE ASIGNAN LOS VALORES ACTUALIZADOS DE lhold y lcancel
		SELECT @nuevo_lcancel=mpchk.lcancel,@nuevo_lhold=mpchk.lhold
			FROM mpsiafi.dbo.apchck AS mpchk
			WHERE cchkno = @num_chk;

		--SE ACTUALIZA LA TABLA tbl_apchck con los valores mas actuales
		UPDATE mpsiafireportes.dbo.tbl_apchck
			SET 	lcancel = @nuevo_lcancel,
				lhold = @nuevo_lhold
			WHERE 	mpsiafireportes.dbo.tbl_apchck.cchkno = @num_chk;


		FETCH cheques INTO @num_chk;
	END

	CLOSE cheques;
	DEALLOCATE cheques;

END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_chk_entregar]
	@num VARCHAR(10),@entr VARCHAR(1)=1
AS
BEGIN
	
	SET NOCOUNT ON;

	UPDATE mpsiafireportes.dbo.tbl_apchck
		SET centregado = @entr
		WHERE cchkno = @num

END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER OFF
GO
CREATE  PROCEDURE [sp_chk_mostrarMonto]
	
AS
BEGIN
	
	SET NOCOUNT ON;

	SELECT TOP 1 mpracchk.namt AS MONTO,mpracchk.dfechamod AS FECHA, 
		mpracchk.cdesc AS 'DESC'
		FROM mpsiafireportes.dbo.tbl_accchk AS mpracchk
		ORDER BY FECHA DESC

END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [sp_chk_montoCuenta]
	@monto NUMERIC(16,2),@desc VARCHAR(200)
AS
BEGIN
	
	SET NOCOUNT ON;

	INSERT INTO tbl_accchk (namt,dfechamod,cdesc)
		VALUES (@monto,GETDATE(),@desc)

END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE  PROCEDURE [sp_chk_calculaDisponible]

AS
BEGIN
	
	SET NOCOUNT ON;
	
	EXEC sp_chk_actualizar;

	SELECT (SELECT TOP 1 namt AS MONTO
			FROM mpsiafireportes.dbo.tbl_accchk AS accchk
			ORDER BY accchk.dfechamod DESC) - ISNULL(SUM(mprchk.nchkamt),0) AS DISPONIBLE
		FROM mpsiafireportes.dbo.tbl_apchck AS mprchk
		WHERE mprchk.centregado <> '0' AND mprchk.lcancel='0'

END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE  PROCEDURE [sp_chk_mostrar]
	@chknum VARCHAR(10) = '',@proveedor VARCHAR(40)='',@banco VARCHAR(10)='',@conciliado SMALLINT = 0, 
	@retenido SMALLINT = 0, @entregado VARCHAR(1)=''
	
AS
BEGIN
	
	SET NOCOUNT ON;

	EXEC sp_chk_actualizar;

	SELECT mprchk.cchkno AS '# CHEQUE' ,mprchk.cvendno AS 'COD. PROV.', mprchk.cpayto AS 'DESC',
		mprchk.cbankno AS 'CTA. BANC.', mprchk.dcheck AS 'F. CHEQUE',mprchk.dcreate AS 'F. CREACION',
		(CASE mprchk.lcancel WHEN 0 THEN 'NO' ELSE 'SI' END) AS 'CONCILIADO',
		(CASE mprchk.lhold WHEN 0 THEN 'NO' ELSE 'SI' END) AS 'RETENIDO',
		mprchk.nchkamt AS CANTIDAD,
		(CASE mprchk.centregado WHEN 0 THEN 'NO' ELSE 'SI' END) AS 'ENTREGADO'
		FROM mpsiafireportes.dbo.tbl_apchck AS mprchk
		WHERE mprchk.cchkno LIKE '%' + @chknum + '%'
			AND mprchk.cpayto LIKE '%' + @proveedor + '%'
			AND mprchk.cbankno LIKE '%' + @banco + '%'
			AND mprchk.lcancel = @conciliado
			AND mprchk.lhold = @retenido
			AND mprchk.centregado LIKE '%' + @entregado + '%'
		

END
GO
ALTER TABLE [tbl_apchck] ADD  DEFAULT ('0') FOR [centregado]
GO
ALTER TABLE [tbl_rol_usuario]  WITH CHECK ADD  CONSTRAINT [tbl_rol_usuario_tbl_rol_FK] FOREIGN KEY([id_rol])
REFERENCES [tbl_rol] ([id_rol])
GO
ALTER TABLE [tbl_rol_usuario] CHECK CONSTRAINT [tbl_rol_usuario_tbl_rol_FK]
GO
ALTER TABLE [tbl_rol_usuario]  WITH NOCHECK ADD  CONSTRAINT [tbl_rol_usuario_tbl_usuarios_FK] FOREIGN KEY([id_usuario])
REFERENCES [tbl_usuarios] ([id_usuario])
GO
ALTER TABLE [tbl_rol_usuario] CHECK CONSTRAINT [tbl_rol_usuario_tbl_usuarios_FK]
GO