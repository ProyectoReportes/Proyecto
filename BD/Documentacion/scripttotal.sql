USE [mpsiafireportes]
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
CREATE PROCEDURE [dbo].[sp_reporte_presupuesto_programa]

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
CREATE PROCEDURE [dbo].[sp_reporte_presupuesto_grupo]

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

CREATE  PROCEDURE [dbo].[sp_reporte_presupuesto_subgrupo]
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
-- =============================================
-- Author:		<Emil Ordoñez>
-- Create date: <2014-08-19>
-- Description:	<Reporte Presupuestario por Programa>
-- =============================================
CREATE PROCEDURE [dbo].[sp_reporte_deducciones_empleados]

AS
BEGIN
	
	SET NOCOUNT ON;
	
	SELECT empl.cempno AS '# EMPLEADO',empl.cfedid AS 'IDENTIDAD',
		empl.cfname AS NOMBRES, empl.clname AS APELLIDOS,
		jobs.cDesc AS CARGO, empl.cdeptno AS 'COD. DEPTO.',
		dept.cdeptname AS 'DEPTO.', misd.cpayno AS PLANILLA,
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

create procedure [dbo].[sp_slFContrato]
	@f_inicio datetime, @f_fin datetime
	AS
begin 
	
	set nocount on;
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and dcntrct between isnull(@f_inicio,'19000101') and isnull(@f_fin, '29001231')
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create procedure [dbo].[sp_slFAcuerdo]
	@f_inicio datetime, @f_fin datetime
	AS
begin 
	
	set nocount on;
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and dhire between isnull(@f_inicio,'19000101') and isnull(@f_fin, '29001231')
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE procedure [dbo].[sp_slCargo]
	@cargo varchar(40)
	AS
begin 
	Select mpsiafi.dbo.prempy.cempno, cfedid, cfname, clname, csex, dbirth, 
	mpsiafi.dbo.prempy.cdeptno, cdeptname, cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, mpsiafi.dbo.prempy.cpaytype, cstate, mpsiafi.dbo.prempg.cwageacc
	from mpsiafi.dbo.prempy, mpsiafi.dbo.HRJobs,
	     mpsiafi.dbo.prdept, mpsiafi.dbo.prempg
	where mpsiafi.dbo.prempy.cdeptno = mpsiafi.dbo.prdept.cdeptno 
	      and mpsiafi.dbo.prempy.cjobtitle = mpsiafi.dbo.HRJobs.cJobTitlNO 
	      and mpsiafi.dbo.prempy.cempno = mpsiafi.dbo.prempg.cempno
	      and cDesc LIKE '%' + @cargo + '%'; 
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[sp_slDpto]
	@dpto char(30)
	AS
begin 

	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and cdeptname = @dpto
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[sp_slCodPresupuestario]
	@codP char(30)
	AS
begin 
	
	set nocount on;
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and empg.cwageacc = @codP
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[sp_slEstado]
	@estado char(2)
	AS
begin 
	
	set nocount on;
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and cstate = @estado
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[sp_slCargo_Dpto]
	@cargo char(40), @dpto char(30) 
	AS
begin 
	
	set nocount on;
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and jobs.cDesc = @cargo  and cdeptname = @dpto
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[sp_slAcuerdo_Contrato]
	@aIn datetime, @aFin datetime, @cIn datetime, @cFin datetime 
	AS
begin 
	
	set nocount on;
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, jobs.cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs jobs,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = jobs.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and dhire between isnull(@aIn,'19000101') and isnull(@aFin, '29001231')
	      and dcntrct between isnull(@cIn,'19000101') and isnull(@cFin, '29001231')
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE procedure [dbo].[sp_slCargo1]
	@cargo varchar(40)
	AS
begin 
	Select mpsiafi.dbo.prempy.cempno, cfedid, cfname, clname, csex, dbirth, 
	mpsiafi.dbo.prempy.cdeptno, cdeptname, cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, mpsiafi.dbo.prempy.cpaytype, cstate, mpsiafi.dbo.prempg.cwageacc
	from mpsiafi.dbo.prempy, mpsiafi.dbo.HRJobs,
	     mpsiafi.dbo.prdept, mpsiafi.dbo.prempg
	where mpsiafi.dbo.prempy.cdeptno = mpsiafi.dbo.prdept.cdeptno 
	      and mpsiafi.dbo.prempy.cjobtitle = mpsiafi.dbo.HRJobs.cJobTitlNO 
	      and mpsiafi.dbo.prempy.cempno = mpsiafi.dbo.prempg.cempno
	      and mpsiafi.dbo.HRJobs.cDesc LIKE '%' + @cargo +'%'; 
end
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_reporte_ingreso_empleados]
AS
BEGIN
SET NOCOUNT ON;
	SELECT E.cempno AS "CODIGO", E.cfedid AS "IDENTIDAD", E.cfname AS "NOMBRES", E.clname AS "APELLIDOS", J.cDesc AS "CARGO", E.cdeptno AS "COD. DEPTO.", 
	D.cdeptname AS "DEPTO.", M.cref AS "REFERENCIA", M.cbankno AS "BANCO", M.cchkno AS "CHEQUE", M.cpayno AS "PLANILLA", M.cpaycode AS "COD. INGR.", 
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
CREATE PROCEDURE [dbo].[sp_reporte_presupuesto_compara]

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
SET QUOTED_IDENTIFIER OFF
GO
CREATE PROCEDURE [dbo].[sp_reporte_presupuesto_transacciones]

AS
BEGIN
	
	SET NOCOUNT ON;

	((SELECT 'TRANS.' AS TIPO,CONVERT(VARCHAR,trn.cfbudno) AS DESDE,
		trn.ctbudno AS HASTA, trn.ntrfamt AS 'CANT.',
		trn.tmodrec AS FECHA
		FROM mpsiafi.dbo.bgtrfm AS trn
		WHERE YEAR(trn.tmodrec) = YEAR(GETDATE())
	)
	UNION
	(SELECT 'AJUST.' AS TIPO,'N/A' AS DESDE,
		aju.cbudno AS HASTA, aju.nadjamt AS 'CANT.',
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
CREATE TABLE [dbo].[tbl_usuarios](
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
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_rol](
	[id_rol] [smallint] NOT NULL,
	[descripcion] [varchar](45) NULL,
 CONSTRAINT [tbl_rol_PK] PRIMARY KEY CLUSTERED 
(
	[id_rol] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_rol_usuario](
	[id_usuario] [varchar](45) NOT NULL,
	[id_rol] [smallint] NOT NULL,
 CONSTRAINT [tbl_rol_usuario_PK] PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC,
	[id_rol] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_login]
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
CREATE PROCEDURE [dbo].[sp_nuevousuario]
	@idusuario VARCHAR(45),@correo VARCHAR(100),
	@prnombre VARCHAR(50),@sgnombre VARCHAR(50)=NULL,
	@prapellido VARCHAR(50),@sgapellido VARCHAR(50)=NULL,
	@clave VARCHAR(50)=NULL,@rol TINYINT=3
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	DECLARE @error INT;
	
    BEGIN TRANSACTION
		INSERT INTO tbl_usuarios (id_usuario,email,prnombre,
				sgnombre,prapellido,sgapellido,clave,fecha_creacion)
			VALUES(@idusuario,@correo,@prnombre,
				@sgnombre,@prapellido,@sgapellido,
				PWDENCRYPT(ISNULL(@clave,'123456')),GETDATE())
		
		INSERT INTO rol_usuarios (id_usuario,id_rol)
			VALUES (@idusuario,@rol)			
		
	SET @error = @@ERROR;	
	IF @error <> 0 BEGIN
		COMMIT
		RETURN 0;
	END
	ELSE BEGIN
		ROLLBACK
		RETURN @error;
	END
	
END
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_reiniciaclave]
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
CREATE PROCEDURE [dbo].[sp_eliminausuario]
	@correo VARCHAR(100)
AS
BEGIN
	
	SET NOCOUNT ON;

	DELETE tbl_usuarios
		WHERE email = @correo
END
GO
ALTER TABLE [dbo].[tbl_rol_usuario]  WITH CHECK ADD  CONSTRAINT [tbl_rol_usuario_tbl_rol_FK] FOREIGN KEY([id_rol])
REFERENCES [dbo].[tbl_rol] ([id_rol])
GO
ALTER TABLE [dbo].[tbl_rol_usuario] CHECK CONSTRAINT [tbl_rol_usuario_tbl_rol_FK]
GO
ALTER TABLE [dbo].[tbl_rol_usuario]  WITH NOCHECK ADD  CONSTRAINT [tbl_rol_usuario_tbl_usuarios_FK] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[tbl_usuarios] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_rol_usuario] CHECK CONSTRAINT [tbl_rol_usuario_tbl_usuarios_FK]
GO
