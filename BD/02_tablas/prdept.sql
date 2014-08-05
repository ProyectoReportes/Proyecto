CREATE TABLE [dbo].[prdept] (
	[cdeptno] [char] (10)  NOT NULL ,
	[cdeptname] [char] (30)  NOT NULL ,
	[cwageacc] [char] (30)  NOT NULL ,
	[ctaxacc] [char] (30)  NOT NULL ,
	[cpaytype] [char] (2)  NOT NULL ,
	[cpayperiod] [char] (2)  NOT NULL ,
	[lallowot] [smallint] NULL ,
	[lepayment] [smallint] NULL ,
	[lusetips] [smallint] NULL ,
	[nrhr] [numeric](8, 2) NOT NULL ,
	[cficaeracc] [char] (30)  NOT NULL ,
	[cmedieracc] [char] (30)  NOT NULL ,
	[cfutaeracc] [char] (30)  NOT NULL ,
	[csutaeracc] [char] (30)  NOT NULL ,
	[cficaacc] [char] (30)  NOT NULL ,
	[cmediacc] [char] (30)  NOT NULL ,
	[cfutaacc] [char] (30)  NOT NULL ,
	[csutaacc] [char] (30)  NOT NULL ,
	[cdeptglseg] [char] (30)  NOT NULL 
) ON [vam_user_data]
GO

