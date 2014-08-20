SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Emil Ordoñez>
-- Create date: <2014-08-19>
-- Description:	<Reporte Presupuestario por Programa>
-- =============================================
CREATE PROCEDURE sp_reporte_presupuesto_programa
	@programa VARCHAR(3)
AS
BEGIN
	
	SET NOCOUNT ON;

	SELECT SUBSTRING(budget.cbudno,5,3) AS PROGRAMA ,budget.cbudno AS PRESUPUESTO,
			ISNULL((SELECT TOP 1 adj.nadjamt
				FROM mpsiafi.dbo.bgadjm AS adj
				WHERE SUBSTRING(adj.cbudno,5,3) = @programa 
					AND SUBSTRING(adj.cbudid,5,4) = YEAR(GETDATE())
					AND adj.lvoid = 0),0) AS TRANSFERENCIA,
			(budget.namtmod - budget.namt) AS MODIFICADO, budget.namtused AS UTILIZADO,
			(budget.namtmod - budget.namtused) AS DISPONIBLE,
			(budget.namtused / budget.namtmod) AS '% UTILIZADO',
			((budget.namtmod - budget.namtused) / budget.namtmod) AS '% DISPONIBLE'
		FROM mpsiafi.dbo.bgbudt AS budget
		WHERE SUBSTRING(budget.cbudno,5,3) = @programa
			AND SUBSTRING(budget.cbudid,5,4) = YEAR(GETDATE())
END
GO