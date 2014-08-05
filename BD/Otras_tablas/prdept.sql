CREATE TABLE [dbo].[prdept] (
	[cdeptno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cdeptname] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cwageacc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ctaxacc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cpaytype] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cpayperiod] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[lallowot] [smallint] NULL ,
	[lepayment] [smallint] NULL ,
	[lusetips] [smallint] NULL ,
	[nrhr] [numeric](8, 2) NOT NULL ,
	[cficaeracc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cmedieracc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cfutaeracc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[csutaeracc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cficaacc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cmediacc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cfutaacc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[csutaacc] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[cdeptglseg] [char] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [vam_user_data]
GO

