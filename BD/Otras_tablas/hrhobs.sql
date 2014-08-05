CREATE TABLE [dbo].[HRJobs] (
	[cJobTitlNO] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cDesc] [char] (40) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[nSalary] [numeric](5, 2) NOT NULL ,
	[nPorPlus] [numeric](5, 2) NOT NULL ,
	[mnotepad] [text] COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[tmodrec] [datetime] NOT NULL 
) ON [vam_user_data] TEXTIMAGE_ON [vam_user_data]
GO

