CREATE DATABASE Asignacionuno

CREATE TABLE Usuario
(
	US_ID INT(10),
	US_Login Varchar(30) NOT NULL,
	US_Pass Varchar(30) NOT NULL,
	US_Mail Varchar(50) NOT NULL,
	US_Nombre Varchar(30) NOT NULL,
	US_Apellido Varchar(30) NOT NULL	
);

ALTER TABLE Usuario ADD CONSTRAINT PK_Usuario PRIMARY KEY (US_ID);
ALTER TABLE Usuario MODIFY COLUMN US_ID INT auto_increment;
ALTER TABLE Usuario ADD CONSTRAINT Unique_Usuario UNIQUE (US_Login,US_Mail);

CREATE TABLE resetPassword
(
	RE_ID INT(10),
	RE_idUsuario INT(10) NOT NULL,
	RE_Login Varchar(30) NOT NULL,
	RE_Token Varchar(64) NOT NULL,
	RE_Creado Timestamp NOT NULL
);

ALTER TABLE resetPassword ADD CONSTRAINT PK_resetPassword PRIMARY KEY (RE_ID);
ALTER TABLE resetPassword MODIFY COLUMN RE_ID INT auto_increment;
ALTER TABLE resetPassword MODIFY COLUMN RE_Creado Timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP; 

CREATE EVENT caduca_link
	ON SCHEDULE EVERY 1 HOUR
	DO
		DELETE FROM resetPassword WHERE RE_Creado <= (NOW() - INTERVAL 2 HOUR);

SET GLOBAL event_scheduler =  "ON";