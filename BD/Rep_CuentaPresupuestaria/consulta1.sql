use mpsiafireportes

create procedure sp_slCargo
	@cargo char(40)
	AS
begin 
	Select empy.cempno, cfedid, cfname, clname, csex, dbirth, 
	empy.cdeptno, cdeptname, cDesc, nmonthpay, dcntrct, dhire,
	ctaxstate, empy.cpaytype, cstate, empg.cwageacc
	from mpsiafi.dbo.prempy empy, mpsiafi.dbo.HRJobs job,
	     mpsiafi.dbo.prdept dept, mpsiafi.dbo.prempg empg
	where empy.cdeptno = dept.cdeptno 
	      and empy.cjobtitle = job.cJobTitlNO 
	      and empy.cempno = empg.cempno
	      and cDesc = @cargo
end

exec sp_slCargo 'Programador'    
	
create procedure sp_slDpto
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

create procedure sp_slCodPresupuestario
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

exec sp_slCodPresupuestario 'adssdfsd'

create procedure sp_slEstado
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

create procedure sp_slFContrato
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

create procedure sp_slFAcuerdo
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
	      and dhire between isnull(@f_inicio,'1900-01-01') and isnull(@f_fin,'2900-12-31')
end

exec sp_slFAcuerdo '10-08-2010','10-18-2011'
exec sp_slFContrato '10-08-2000','10-08-2011'

create procedure sp_slCargo_Dpto
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

create procedure sp_slAcuerdo_Contrato
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

exec sp_slAcuerdo_Contrato '15-05-2010','31-12-2010', '01-01-2008', '31-12-2011'