-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.15-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para bd_almacen_amr
DROP DATABASE IF EXISTS `bd_almacen_amr`;
CREATE DATABASE IF NOT EXISTS `bd_almacen_amr` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_almacen_amr`;

-- Volcando estructura para tabla bd_almacen_amr.backupfuerte
DROP TABLE IF EXISTS `backupfuerte`;
CREATE TABLE IF NOT EXISTS `backupfuerte` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Seguridad` varchar(50) NOT NULL,
  `Fecha_baja` date NOT NULL,
  `Estanteria` int(11) NOT NULL,
  `Leja` int(11) NOT NULL,
  UNIQUE KEY `Código` (`Código`),
  KEY `ID` (`ID`),
  KEY `FK_backupfuerte_estanteria` (`Estanteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.backupfuerte: ~0 rows (aproximadamente)
DELETE FROM `backupfuerte`;
/*!40000 ALTER TABLE `backupfuerte` DISABLE KEYS */;
/*!40000 ALTER TABLE `backupfuerte` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.backupnegra
DROP TABLE IF EXISTS `backupnegra`;
CREATE TABLE IF NOT EXISTS `backupnegra` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Placa_base` varchar(50) NOT NULL,
  `Fecha_baja` date NOT NULL,
  `Estanteria` int(11) NOT NULL,
  `Leja` int(11) NOT NULL,
  UNIQUE KEY `Código` (`Código`),
  KEY `ID` (`ID`),
  KEY `FK_backupnegra_estanteria` (`Estanteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.backupnegra: ~0 rows (aproximadamente)
DELETE FROM `backupnegra`;
/*!40000 ALTER TABLE `backupnegra` DISABLE KEYS */;
/*!40000 ALTER TABLE `backupnegra` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.backupsorpresa
DROP TABLE IF EXISTS `backupsorpresa`;
CREATE TABLE IF NOT EXISTS `backupsorpresa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Contenido` varchar(50) NOT NULL,
  `Fecha_baja` date NOT NULL,
  `Estanteria` int(11) NOT NULL,
  `Leja` int(11) NOT NULL,
  UNIQUE KEY `Codigo` (`Código`),
  KEY `ID` (`ID`),
  KEY `FK_backupsorpresa_estanteria` (`Estanteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.backupsorpresa: ~1 rows (aproximadamente)
DELETE FROM `backupsorpresa`;
/*!40000 ALTER TABLE `backupsorpresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `backupsorpresa` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.backupsorpresaespecial
DROP TABLE IF EXISTS `backupsorpresaespecial`;
CREATE TABLE IF NOT EXISTS `backupsorpresaespecial` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Contenido` varchar(50) NOT NULL,
  `Fecha_baja` date NOT NULL,
  `Estanteria` int(11) NOT NULL,
  `Leja` int(11) NOT NULL,
  UNIQUE KEY `Codigo` (`Código`),
  KEY `ID` (`ID`),
  KEY `FK_backupsorpresa_estanteria` (`Estanteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.backupsorpresaespecial: ~0 rows (aproximadamente)
DELETE FROM `backupsorpresaespecial`;
/*!40000 ALTER TABLE `backupsorpresaespecial` DISABLE KEYS */;
/*!40000 ALTER TABLE `backupsorpresaespecial` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.estanteria
DROP TABLE IF EXISTS `estanteria`;
CREATE TABLE IF NOT EXISTS `estanteria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL DEFAULT '0',
  `Material` varchar(50) NOT NULL DEFAULT '0',
  `Numero_Lejas` int(11) NOT NULL DEFAULT '0',
  `Lejas_Ocupadas` int(11) NOT NULL DEFAULT '0',
  `Pasillo` varchar(50) NOT NULL DEFAULT '0',
  `Número` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `Código` (`Código`),
  UNIQUE KEY `Pasillo_Número` (`Pasillo`,`Número`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.estanteria: ~1 rows (aproximadamente)
DELETE FROM `estanteria`;
/*!40000 ALTER TABLE `estanteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `estanteria` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.fuerte
DROP TABLE IF EXISTS `fuerte`;
CREATE TABLE IF NOT EXISTS `fuerte` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Seguridad` varchar(50) NOT NULL,
  `Fecha_alta` date NOT NULL,
  `Fecha_baja` date DEFAULT NULL,
  UNIQUE KEY `Código` (`Código`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.fuerte: ~0 rows (aproximadamente)
DELETE FROM `fuerte`;
/*!40000 ALTER TABLE `fuerte` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuerte` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.negra
DROP TABLE IF EXISTS `negra`;
CREATE TABLE IF NOT EXISTS `negra` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `PlacaBase` varchar(50) NOT NULL,
  `Fecha_alta` date NOT NULL,
  `Fecha_baja` date DEFAULT NULL,
  UNIQUE KEY `Código` (`Código`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.negra: ~1 rows (aproximadamente)
DELETE FROM `negra`;
/*!40000 ALTER TABLE `negra` DISABLE KEYS */;
/*!40000 ALTER TABLE `negra` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.ocupación
DROP TABLE IF EXISTS `ocupación`;
CREATE TABLE IF NOT EXISTS `ocupación` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_estanteria` int(11) NOT NULL,
  `Leja` int(11) NOT NULL,
  `ID_caja` int(11) NOT NULL,
  `TipoCaja` varchar(50) NOT NULL,
  UNIQUE KEY `ID_caja_tipo_caja` (`ID_caja`,`TipoCaja`),
  KEY `ID` (`ID`),
  KEY `FK_ocupación_estanteria` (`ID_estanteria`),
  CONSTRAINT `FK_ocupación_estanteria` FOREIGN KEY (`ID_estanteria`) REFERENCES `estanteria` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.ocupación: ~0 rows (aproximadamente)
DELETE FROM `ocupación`;
/*!40000 ALTER TABLE `ocupación` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocupación` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.sorpresa
DROP TABLE IF EXISTS `sorpresa`;
CREATE TABLE IF NOT EXISTS `sorpresa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Código` varchar(50) NOT NULL,
  `Altura` int(11) NOT NULL,
  `Anchura` int(11) NOT NULL,
  `Profundidad` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Contenido` varchar(50) NOT NULL,
  `Fecha_alta` date NOT NULL,
  `Fecha_baja` date DEFAULT NULL,
  `Especial` int(1) NOT NULL,
  UNIQUE KEY `Código` (`Código`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.sorpresa: ~0 rows (aproximadamente)
DELETE FROM `sorpresa`;
/*!40000 ALTER TABLE `sorpresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `sorpresa` ENABLE KEYS */;

-- Volcando estructura para tabla bd_almacen_amr.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  UNIQUE KEY `Usuario_Columna 3` (`Usuario`,`Contraseña`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla bd_almacen_amr.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para disparador bd_almacen_amr.backupfuerte_after_delete
DROP TRIGGER IF EXISTS `backupfuerte_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupfuerte_after_delete` AFTER DELETE ON `backupfuerte` FOR EACH ROW begin
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
          DECLARE last_id INT;
	  DECLARE antes INT DEFAULT 0;
	  DECLARE despues INT DEFAULT 0;
          
          select count(*) into comprobari from fuerte;
	  select count(*) into comprobario from ocupación;

	  select ID into ID_ from backupfuerte where Código = OLD.Código;
          
	  INSERT INTO fuerte VALUES(null, OLD.Código, OLD.Altura, OLD.Anchura, OLD.Profundidad, OLD.Color, OLD.Seguridad, CURDATE(), OLD.Fecha_baja);
          
	  select Lejas_Ocupadas into antes from estanteria where estanteria.ID = '3';
	  UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='3';
	  select Lejas_Ocupadas into despues from estanteria where estanteria.ID = '3';
	            
          SELECT MAX(ID) into last_id FROM fuerte;
          INSERT INTO ocupación VALUES(null, '3', '2', last_id, 'caja_fuerte');
          
          select count(*) into comprobar1 from fuerte where Código = OLD.Código;
          
          select count(*) into comprobarf from fuerte;
	  select count(*) into comprobarfo from ocupación;
          
          if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5013', MESSAGE_TEXT = 'error no existe la caja fuerte.';
	  end if;
          if (antes = despues) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5020', MESSAGE_TEXT = 'error al actualizar las lejas de la estanteria.';
	  end if;
          if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha insertado la caja fuerte.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha insertado la ocupación.';
	  end if;
    end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.backupfuerte_after_insert
DROP TRIGGER IF EXISTS `backupfuerte_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupfuerte_after_insert` AFTER INSERT ON `backupfuerte` FOR EACH ROW begin
	  DECLARE comprobar INT DEFAULT 0;
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
	  
 	  select count(*) into comprobari from fuerte;
	  select count(*) into comprobario from ocupación;
	  
	  select count(*) into comprobar from fuerte where fuerte.Código = NEW.Código;
	  select ID into ID_ from fuerte where fuerte.Código = NEW.Código;
	  select count(*) into comprobar1 from ocupación where ocupación.ID_caja = ID_;
	  
	  delete from fuerte where fuerte.Código = NEW.Código;
	  delete from ocupación where ID_=ocupación.ID_caja and ocupación.TipoCaja='caja_fuerte';
	  
 	  select count(*) into comprobarf from fuerte;
	  select count(*) into comprobarfo from ocupación;
	  
	  if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5006', MESSAGE_TEXT = 'error no existe la caja fuerte en esa ocupación.';
	  end if;
	  if (comprobar = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5004', MESSAGE_TEXT = 'error no existe la caja fuerte.';
	  end if;
	  if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la caja fuerte.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la ocupación.';
	  end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.backupnegra_after_delete
DROP TRIGGER IF EXISTS `backupnegra_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupnegra_after_delete` AFTER DELETE ON `backupnegra` FOR EACH ROW begin
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE ID_ INT;
          DECLARE last_id INT;
	  DECLARE antes INT DEFAULT 0;
	  DECLARE despues INT DEFAULT 0;
	  
	  select ID into ID_ from backupnegra where Código = OLD.Código;
          
	  INSERT INTO negra VALUES(null, OLD.Código, OLD.Altura, OLD.Anchura, OLD.Profundidad, OLD.Color, OLD.Placa_base, CURDATE(), OLD.Fecha_baja);
          
	  select Lejas_Ocupadas into antes from estanteria where estanteria.ID = OLD.Estanteria;
	  UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID=OLD.Estanteria;
	  select Lejas_Ocupadas into despues from estanteria where estanteria.ID = OLD.Estanteria;
	            
          SELECT MAX(ID) into last_id FROM negra;
          INSERT INTO ocupación VALUES(null, '3', '5', last_id, 'caja_negra');
          
          select count(*) into comprobar1 from negra where Código = OLD.Código;
          
          if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5013', MESSAGE_TEXT = 'error no existe la caja fuerte.';
	  end if;
          if (antes = despues) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5020', MESSAGE_TEXT = 'error al actualizar las lejas de la estanteria.';
	  end if;
    end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.backupnegra_after_insert
DROP TRIGGER IF EXISTS `backupnegra_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupnegra_after_insert` AFTER INSERT ON `backupnegra` FOR EACH ROW begin
	  DECLARE comprobar INT DEFAULT 0;
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
	  
  	  select count(*) into comprobari from negra;
	  select count(*) into comprobario from ocupación;
	  
	  select ID into ID_ from negra where negra.Código = NEW.Código;
	  select count(*) into comprobar from ocupación where ocupación.ID_caja = ID_;
	  select count(*) into comprobar1 from negra where negra.Código = NEW.Código;
	  
	  delete from ocupación where ID_=ocupación.ID_caja and ocupación.TipoCaja='caja_negra';
	  delete from negra where negra.Código = NEW.Código;
	  
  	  select count(*) into comprobarf from negra;
	  select count(*) into comprobarfo from ocupación;
	  
	  if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5003', MESSAGE_TEXT = 'error no existe la caja negra.';
	  end if;
	  if (comprobar = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5006', MESSAGE_TEXT = 'error no existe la caja negra en esa ocupación.';
	  end if;
	  if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la caja negra.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la ocupación.';
	  end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.backupsorpresaespecial_after_insert
DROP TRIGGER IF EXISTS `backupsorpresaespecial_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupsorpresaespecial_after_insert` AFTER INSERT ON `backupsorpresaespecial` FOR EACH ROW begin
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobar INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
	  
	  select count(*) into comprobari from sorpresa;
	  select count(*) into comprobario from ocupación;
	  
	  select count(*) into comprobar1 from sorpresa where sorpresa.Código = NEW.Código;
	  select ID into ID_ from sorpresa where Código = NEW.Código;
	  select count(*) into comprobar from ocupación where ocupación.ID_caja = ID_;
	  
	  delete from ocupación where ID_=ocupación.ID_caja and ocupación.TipoCaja='caja_sorpresa';
	  delete from sorpresa where sorpresa.Código = NEW.Código;
	  
	  select count(*) into comprobarf from sorpresa;
	  select count(*) into comprobarfo from ocupación;
	  
	  if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5002', MESSAGE_TEXT = 'error no existe la caja sorpresa.';
	  end if;
	  if (comprobar = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'error no existe la caja sorpresa en esa ocupación.';
	  end if;
	  if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la caja sorpresa.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la ocupación.';
	  end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.backupsorpresa_after_delete
DROP TRIGGER IF EXISTS `backupsorpresa_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupsorpresa_after_delete` AFTER DELETE ON `backupsorpresa` FOR EACH ROW begin
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
          DECLARE last_id INT;
	  DECLARE antes INT DEFAULT 0;
	  DECLARE despues INT DEFAULT 0;
          
          select count(*) into comprobari from sorpresa;
	  select count(*) into comprobario from ocupación;
	  
	  select ID into ID_ from backupsorpresa where Código = OLD.Código;
          
	  INSERT INTO sorpresa VALUES(null, OLD.Código, OLD.Altura, OLD.Anchura, OLD.Profundidad, OLD.Color, OLD.Contenido, CURDATE(), OLD.Fecha_baja, 1);
          
	  select Lejas_Ocupadas into antes from estanteria where estanteria.ID = '2';
	  UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='2';
	  select Lejas_Ocupadas into despues from estanteria where estanteria.ID = '2';
	  
          SELECT MAX(ID) into last_id FROM sorpresa;
          INSERT INTO ocupación VALUES(null, '2', '0', last_id, 'caja_sorpresa');
              
          select count(*) into comprobar1 from sorpresa where Código = OLD.Código;
          
          select count(*) into comprobarf from sorpresa;
	  select count(*) into comprobarfo from ocupación;
          
          if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5011', MESSAGE_TEXT = 'error no existe la caja sorpresa.';
	  end if;
          if (antes = despues) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5020', MESSAGE_TEXT = 'error al actualizar las lejas de la estanteria.';
	  end if;
          if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la caja sorpresa.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la ocupación.';
	  end if;
    end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.backupsorpresa_after_insert
DROP TRIGGER IF EXISTS `backupsorpresa_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupsorpresa_after_insert` AFTER INSERT ON `backupsorpresa` FOR EACH ROW begin
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobar INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
	  
	  select count(*) into comprobari from sorpresa;
	  select count(*) into comprobario from ocupación;
	  
	  select count(*) into comprobar1 from sorpresa where sorpresa.Código = NEW.Código;
	  select ID into ID_ from sorpresa where Código = NEW.Código;
	  select count(*) into comprobar from ocupación where ocupación.ID_caja = ID_;
	  
	  delete from ocupación where ID_=ocupación.ID_caja and ocupación.TipoCaja='caja_sorpresa';
	  delete from sorpresa where sorpresa.Código = NEW.Código;
	  
	  select count(*) into comprobarf from sorpresa;
	  select count(*) into comprobarfo from ocupación;
	  
	  if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5002', MESSAGE_TEXT = 'error no existe la caja sorpresa.';
	  end if;
	  if (comprobar = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'error no existe la caja sorpresa en esa ocupación.';
	  end if;
	  if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la caja sorpresa.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la ocupación.';
	  end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador bd_almacen_amr.ocupación_after_delete
DROP TRIGGER IF EXISTS `ocupación_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `ocupación_after_delete` AFTER DELETE ON `ocupación` FOR EACH ROW begin 
	  DECLARE comprobar INT DEFAULT 0;
	  DECLARE antes INT DEFAULT 0;
	  DECLARE despues INT DEFAULT 0;
	  
	  select count(*) into comprobar from estanteria where estanteria.ID = OLD.ID_estanteria;
	  
	  select Lejas_Ocupadas into antes from estanteria where estanteria.ID = OLD.ID_estanteria;
	  update estanteria set estanteria.Lejas_Ocupadas = estanteria.Lejas_Ocupadas - 1 where estanteria.ID = OLD.ID_estanteria;
	  select Lejas_Ocupadas into despues from estanteria where estanteria.ID = OLD.ID_estanteria;
	  
	  if (comprobar = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5000', MESSAGE_TEXT = 'error no existe la tabla.';
	  end if;
	  if (antes = despues) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5001', MESSAGE_TEXT = 'error al actualizar las lejas de la estanteria.';
	  end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
