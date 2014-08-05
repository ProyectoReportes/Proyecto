if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[bgbudp]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[bgbudp]
GO

CREATE TABLE [dbo].[bgbudp] (
	[cuid] [char] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cbudid] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cbudno] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cyear] [char] (4) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cpdno] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[namt] [numeric](16, 2) NOT NULL ,
	[namtused] [numeric](16, 2) NOT NULL ,
	[nqty] [numeric](16, 4) NOT NULL ,
	[nqtyused] [numeric](16, 4) NOT NULL ,
	[tmodrec] [datetime] NOT NULL ,
	[namtaccr] [numeric](16, 2) NOT NULL ,
	[nqtyaccr] [numeric](16, 4) NOT NULL ,
	[namtmod] [numeric](16, 2) NOT NULL ,
	[nqtymod] [numeric](16, 4) NOT NULL 
) ON [vam_user_data]
GO

