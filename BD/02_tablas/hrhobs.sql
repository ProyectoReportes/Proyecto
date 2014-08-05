CREATE TABLE [dbo].[HRJobs] (
	[cJobTitlNO] [char] (10)  NOT NULL ,
	[cDesc] [char] (40)  NOT NULL ,
	[nSalary] [numeric](5, 2) NOT NULL ,
	[nPorPlus] [numeric](5, 2) NOT NULL ,
	[mnotepad] [text]  NULL ,
	[tmodrec] [datetime] NOT NULL 
) ON [vam_user_data] TEXTIMAGE_ON [vam_user_data]
GO

