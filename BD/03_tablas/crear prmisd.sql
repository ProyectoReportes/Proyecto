CREATE TABLE [dbo].[prmisd] (
	[cuid] [char] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cempno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cdedno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cdedcode] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cpayno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ndedamt] [numeric](16, 2) NOT NULL ,
	[tmodrec] [datetime] NOT NULL ,
	[lsystem] [smallint] NOT NULL ,
	[cdesc] [char] (54) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ctrsno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [vam_user_data]
GO

cempno= codigo empleado
cdedno= codigo deduccion
cdedcode= ?
cpayno= nombre de la planilla ejem agosto2014
cdesc= descripcion de l adeduccion

