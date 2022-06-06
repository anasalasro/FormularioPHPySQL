# Script de la estructura de la base de datos
```sql
USE [Mascotas]
GO
/****** TABLA DE PROPIETARIOS ******/
/****** Object:  Table [dbo].[propietario] ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[propietario](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[dni] [char](9) NOT NULL,
 CONSTRAINT [PK_propietario] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, 
ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[propietario]  WITH CHECK ADD  CONSTRAINT [FK_propietario_propietario] FOREIGN KEY([id])
REFERENCES [dbo].[propietario] ([id])
GO

ALTER TABLE [dbo].[propietario] CHECK CONSTRAINT [FK_propietario_propietario]
GO

/****** TABLA DE MASCOTAS ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[mascotas](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[edad] [smallint] NOT NULL,
	[id_propietario] [bigint] NOT NULL,
 CONSTRAINT [PK__mascotas__3213E83FDEFBA5EA] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON,
OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[mascotas]  WITH CHECK ADD  CONSTRAINT [FK_mascotas_propietario] FOREIGN KEY([id_propietario])
REFERENCES [dbo].[propietario] ([id])
ON DELETE CASCADE
GO

ALTER TABLE [dbo].[mascotas] CHECK CONSTRAINT [FK_mascotas_propietario]
GO

/****** VISTA PARA UNIR AMBAS TABLAS ******/
/****** Object:  View [dbo].[v_Mascotas] ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[v_Mascotas]
AS
SELECT        m.id, m.nombre, m.edad, p.nombre AS Propietario, p.dni, m.id_propietario
FROM            dbo.mascotas AS m LEFT OUTER JOIN
                         dbo.propietario AS p ON m.id_propietario = p.id
GO

/****** INSERTAR PROPIETARIOS ******/

INSERT INTO [dbo].[propietario]
           ([nombre]
           ,[dni])
     VALUES
        	(Lola, 45226644S),
		(Juan, 45234655L);
GO

/****** INSERTAR MASCOTAS ******/

INSERT INTO [dbo].[mascotas]
           ([nombre]
           ,[edad]
           ,[id_propietario])
     VALUES
        	('Sally', 3, 1),
		('Balú', 2, 2);
GO
```
