CREATE TABLE bgtrfm (
    ctrfno char (10)  NULL,
    cbudid char (10)  NULL,
    cfbudno char (30)  NULL,
    ctbudno char (30)  NULL,
    cappcode char (20)  NULL,
    cdesc char (54)  NULL,
    dtrs datetime NULL,
    cuser char (20)  NULL,
    ntrfamt numeric(16, 2) NULL,
    ntrfqty numeric(16, 4) NULL,
    mnotepad text  NULL,
    tmodrec datetime NULL,
    lvoid smallint NULL,
    dvoid datetime NULL
)
GO
