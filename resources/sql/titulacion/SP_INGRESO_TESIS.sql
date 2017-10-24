USE [BdAcademico]
GO

/******
     Object: StoredProcedure [dbo].[SP_INGRESO_TESIS]
       Date: 20-Oct-17
     Author:
Description: Genera el código de tesis e ingresa un nuevo registro en TB_TESIS
******/

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

IF OBJECT_ID('SP_INGRESO_TESIS') IS NULL
    EXEC('CREATE PROCEDURE SP_INGRESO_TESIS AS SET NOCOUNT ON;')
GO

ALTER Procedure [dbo].[SP_INGRESO_TESIS] (  @P_COD_CARRERA char(6),
                                            @P_TEMA varchar(500),
                                            @P_ESTADO char(1),
                                            @P_FECHA_PRESENTO datetime,
                                            @P_FECHA_APRONEGA datetime,
                                            @P_FECHA_SUSTENTO datetime,
                                            @P_TIPT char(1),
                                            @P_RESPONSA1 char(10),
                                            @P_RESPONSA2 char(10),
                                            @P_FECSYS1 datetime,
                                            @P_FECSYS2 datetime,
                                            @P_COD_PLECTIVO nchar(20),
                                            @P_AREA_INVESTIGACION_ID numeric(9))
  AS

  DECLARE @XSECU     NUMERIC(5)
  DECLARE @YSECU     CHAR(5)
  DECLARE @C_CARRERA CHAR(6)
  DECLARE @COD_TESIS CHAR(11)

  BEGIN TRANSACTION

    BEGIN

    SELECT @COD_TESIS =
    CASE
    WHEN (SELECT MAX(COD_TESIS) FROM TB_TESIS --(INDEX = KEY_TESIS_COD_CARRERA)
    WHERE COD_CARRERA = @P_COD_CARRERA)
    IS NULL THEN REPLICATE('0',11)
    ELSE (SELECT MAX(COD_TESIS) FROM TB_TESIS --(INDEX = KEY_TESIS_COD_CARRERA)
    WHERE COD_CARRERA = @P_COD_CARRERA)
    END

    SELECT @C_CARRERA     = @P_COD_CARRERA
    SELECT @P_COD_CARRERA = Rtrim(@P_COD_CARRERA) + '00000'
    SELECT @XSECU         = Convert(NUMERIC (5),Substring(@COD_TESIS,7,5))
    SELECT @XSECU         = @XSECU + 1
    SELECT @YSECU         = Convert(VARCHAR,(@XSECU))
    SELECT @COD_TESIS     = @P_COD_CARRERA + Replicate('0',5 - Datalength(Rtrim(@YSECU))) + @YSECU

	INSERT INTO TB_TESIS (  COD_TESIS,
                            COD_CARRERA,
                            TEMA,
                            ESTADO,
                            FECHA_PRESENTO,
                            FECHA_APRONEGA,
                            FECHA_SUSTENTO,
                            TIPT,
                            RESPONSA1,
                            RESPONSA2,
                            FECSYS1,
                            FECSYS2,
                            COD_PLECTIVO,
                            AREA_INVESTIGACION_ID)
                          VALUES
                         (  @COD_TESIS,
                            @P_COD_CARRERA,
                            @P_TEMA,
                            @P_ESTADO,
                            @P_FECHA_PRESENTO,
                            @P_FECHA_APRONEGA,
                            @P_FECHA_SUSTENTO,
                            @P_TIPT,
                            @P_RESPONSA1,
                            @P_RESPONSA2,
                            @P_FECSYS1,
                            @P_FECSYS2,
                            @P_COD_PLECTIVO,
                            @P_AREA_INVESTIGACION_ID
                         )

       COMMIT TRANSACTION
END