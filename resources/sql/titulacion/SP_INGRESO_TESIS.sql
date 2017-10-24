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

IF OBJECT_ID(''SP_INGRESO_TESIS'') IS NULL
    EXEC(''CREATE PROCEDURE SP_INGRESO_TESIS AS SET NOCOUNT ON;'')
GO

ALTER Procedure [dbo].[SP_INGRESO_TESIS] (  @_COD_TESIS char(6),
                                            @_COD_CARRERA char(6),
                                            @_TEMA varchar(500),
                                            @_ESTADO char(1),
                                            @_FECHA_PRESENTO datetime,
                                            @_FECHA_APRONEGA datetime,
                                            @_FECHA_SUSTENTO datetime,
                                            @_TIPT char(1),
                                            @_RESPONSA1 char(10),
                                            @_RESPONSA2 char(10),
                                            @_FECSYS1 datetime,
                                            @_FECSYS2 datetime,
                                            @_COD_PLECTIVO nchar(20),
                                            @_AREA_INVESTIGACION_ID numeric(9))
AS

DECLARE @XSECU     NUMERIC(5)
DECLARE @YSECU     CHAR(5)
DECLARE @C_CARRERA CHAR(6)
DECLARE @COD_TESIS CHAR(11)

/*
CAMPOS PARA ACTUALIZACION DE TESIS
*/
DECLARE @L_COD_TESIS char(6)
DECLARE @L_COD_CARRERA char(6)
DECLARE @L_TEMA varchar(500)
DECLARE @L_ESTADO char(1)
DECLARE @L_FECHA_PRESENTO datetime
DECLARE @L_FECHA_APRONEGA datetime
DECLARE @L_FECHA_SUSTENTO datetime
DECLARE @L_TIPT char(1)
DECLARE @L_RESPONSA1 char(10)
DECLARE @L_RESPONSA2 char(10)
DECLARE @L_FECSYS1 datetime
DECLARE @L_FECSYS2 datetime
DECLARE @L_COD_PLECTIVO nchar(20)
DECLARE @L_AREA_INVESTIGACION_ID numeric(9)


SET NOCOUNT ON;


BEGIN

BEGIN TRY

IF @_COD_TESIS IS NULL


	BEGIN
	BEGIN TRANSACTION
	SET @COD_TESIS = CASE WHEN (SELECT MAX(COD_TESIS) FROM TB_TESIS WHERE COD_CARRERA = @_COD_CARRERA) IS NULL THEN REPLICATE(''0'',11)
						  ELSE (SELECT MAX(COD_TESIS) FROM TB_TESIS WHERE COD_CARRERA = @_COD_CARRERA) END
	SET @C_CARRERA = Rtrim(@_COD_CARRERA) + ''00000''
	SET @XSECU     = Convert(NUMERIC (5),Substring(@COD_TESIS,7,5))
	SET @YSECU     = Convert(VARCHAR,(@XSECU + 1))
	SET @COD_TESIS = @C_CARRERA + Replicate(''0'',5 - Datalength(Rtrim(@YSECU))) + @YSECU
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
					  VALUES (  @COD_TESIS,
								@_COD_CARRERA,
								@_TEMA,
								@_ESTADO,
								@_FECHA_PRESENTO,
								@_FECHA_APRONEGA,
								@_FECHA_SUSTENTO,
								@_TIPT,
								@_RESPONSA1,
								@_RESPONSA2,
								@_FECSYS1,
								@_FECSYS2,
								@_COD_PLECTIVO,
								@_AREA_INVESTIGACION_ID
								)
		COMMIT TRANSACTION
		SELECT 0 AS ID, ''GUARDADO EXITOSO'' AS MSG
	END
else
	SELECT 3 AS ID, @_COD_TESIS AS MSG
	/*
ELSE

	BEGIN
		SELECT  @L_COD_TESIS	  =  CASE @_COD_TESIS WHEN NULL THEN COD_TESIS ELSE @_COD_TESIS END,
				@L_COD_CARRERA	  =  COD_CARRERA  ,
				@L_TEMA			  =  TEMA   ,
				@L_ESTADO		  =  ESTADO ,
				@L_FECHA_PRESENTO =  FECHA_PRESENTO  ,
				@L_FECHA_APRONEGA =  FECHA_APRONEGA  ,
				@L_FECHA_SUSTENTO =  FECHA_SUSTENTO  ,
				@L_TIPT			  =  TIPT ,
				@L_RESPONSA1	  =  RESPONSA1 ,
				@L_RESPONSA2      =  RESPONSA2 ,
				@L_FECSYS1		  =  FECSYS1  ,
				@L_FECSYS2		  =  FECSYS2  ,
				@L_COD_PLECTIVO   =  COD_PLECTIVO ,
				@L_AREA_INVESTIGACION_ID   =  AREA_INVESTIGACION_ID
		FROM TB_TESIS WHERE COD_TESIS = @_COD_TESIS;
		IF @L_COD_TESIS = NULL
			SELECT 1 AS ID, ''	'' AS MSG
	END
	*/
END TRY

BEGIN CATCH
	ROLLBACK TRANSACTION

SELECT ERROR_NUMBER() AS ID, ERROR_MESSAGE() AS MSG

END CATCH;

END