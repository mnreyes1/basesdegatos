
# COMANDOS PARA CREAR TABLAS

DROP TABLE IF EXISTS Socios;
CREATE TABLE Socios(
	snombre VARCHAR(100),
	apellido VARCHAR(100),
	nacionalidad VARCHAR(100));


DROP TABLE IF EXISTS Proyectos;
CREATE TABLE Proyectos(
	tipo VARCHAR(20),
	pnombre VARCHAR(100) PRIMARY KEY, 
	latitud FLOAT, 
	longitud FLOAT, 
	comuna VARCHAR(50), 
	fecha_apertura DATE, 
	operativo BOOLEAN);


DROP TABLE IF EXISTS Recursos;
CREATE TABLE Recursos(
	numero CHAR(14) PRIMARY KEY, 
	causa VARCHAR(100), 
	area FLOAT, 
	descripcion TEXT, 
	fecha_apertura DATE, 
	comuna VARCHAR(50), 
	status VARCHAR(20));

DROP TABLE IF EXISTS Mineras;
CREATE TABLE Mineras(
	mineral VARCHAR(50), 
	pnombre VARCHAR(100) PRIMARY KEY, 
	FOREIGN KEY (pnombre) REFERENCES Proyectos (pnombre) ON DELETE CASCADE);

DROP TABLE IF EXISTS Comunas;
CREATE TABLE Comunas(
	comuna VARCHAR(50) PRIMARY KEY, 
	region VARCHAR(100));

DROP TABLE IF EXISTS Centrales;
CREATE TABLE Centrales(
	pnombre VARCHAR(100) PRIMARY KEY, 
	generacion VARCHAR(50),  
	FOREIGN KEY (pnombre) REFERENCES Proyectos (pnombre) ON DELETE CASCADE);

DROP TABLE IF EXISTS Tramitados;
CREATE TABLE Tramitados(
	fecha_dictamen DATE, 
	numero CHAR(14) PRIMARY KEY, 
	FOREIGN KEY (numero) REFERENCES Recursos (numero) ON DELETE CASCADE);

DROP TABLE IF EXISTS SociosProyectos;
CREATE TABLE SociosProyectos(
	apellido VARCHAR(100), 
	pnombre VARCHAR(100), 
	snombre VARCHAR(100), 
	FOREIGN KEY (apellido, snombre) REFERENCES Socios (apellido, snombre) ON DELETE CASCADE,
	FOREIGN KEY (pnombre) REFERENCES Proyectos (pnombre) ON DELETE CASCADE);

DROP TABLE IF EXISTS RecursosProyectos;
CREATE TABLE RecursosProyectos(
	numero CHAR(14) PRIMARY KEY,
	pnombre VARCHAR(100), 
	FOREIGN KEY (pnombre) REFERENCES Proyectos (pnombre) ON DELETE CASCADE,
	FOREIGN KEY (numero) REFERENCES Recursos (numero) ON DELETE CASCADE);


# CONSULTAS

#1
SELECT pnombre FROM Centrales
WHERE generacion='termoeléctrica';

#2
SELECT pnombre FROM Proyectos WHERE tipo='vertedero';

#3
SELECT numero FROM 
Recursos NATURAL JOIN RecursosProyectos NATURAL JOIN Mineras
WHERE fecha_apertura >= '1990-01-01' AND fecha_apertura <= '2010-12-31';

#4
SELECT DISTINCT region FROM
Recursos NATURAL JOIN Comunas
WHERE status='en trámite';

#5
SELECT apellido, snombre, pnombre, count FROM
(SELECT pnombre, COUNT(*) AS count FROM
Recursos NATURAL JOIN RecursosProyectos
WHERE status='en trámite'
GROUP BY pnombre) AS np NATURAL JOIN SociosProyectos 
ORDER BY 
apellido,
count DESC;

#6 
SELECT DISTINCT pnombre FROM
Proyectos NATURAL JOIN RecursosProyectos NATURAL JOIN Recursos
WHERE status='aprobado'
AND operativo=True;

