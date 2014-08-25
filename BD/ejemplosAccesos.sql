SELECT *
	FROM mp.dbo.HRJobs



EXEC sp_ins 'Desarrollo', 110

CREATE PROCEDURE sp_ins
	@desc VARCHAR(40), @salario DECIMAL(5,2)
	AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO mp.dbo.HRJobs
		VALUES('003',@desc,@salario,10,'NOTA2','20141110')

	END

