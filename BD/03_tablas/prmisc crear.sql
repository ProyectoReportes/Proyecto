CREATE TABLE [dbo].[prmisc] (
	[cuid] [char] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cempno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[clname] [char] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cfname] [char] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ctaxstate] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cdeptno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cpaytype] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cref] [char] (54) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ctrsno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cbankno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cchkno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[dtrs] [datetime] NULL ,
	[dcheck] [datetime] NULL ,
	[ltaxable] [smallint] NULL ,
	[nothtax] [numeric](16, 2) NULL ,
	[nothntax] [numeric](16, 2) NULL ,
	[csegid1] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[csegid2] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[csegid3] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[csegid4] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[csegid5] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[csegmid] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ccycle] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cpayno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cpaycode] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[nqty] [numeric](16, 4) NULL ,
	[nrate] [numeric](16, 4) NULL ,
	[lsystem] [smallint] NULL ,
	[nothertax] [numeric](16, 2) NULL ,
	[nBaseGrTax] [numeric](16, 2) NULL ,
	[cdocno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cdoctyp] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [vam_user_data]
GO

ingresos
nqty * nrate = valor del ingreso


