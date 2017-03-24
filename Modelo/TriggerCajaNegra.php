<?php

    $borrar="DROP TRIGGER IF EXISTS backupnegra_after_delete";
    $resultado3=$conexion->query($borrar);
    
    $triggerFuerte="
          CREATE TRIGGER backupnegra_after_delete AFTER DELETE ON backupnegra FOR EACH ROW 
    begin
	  DECLARE comprobar1 INT DEFAULT 0;
	  DECLARE comprobari INT DEFAULT 0;
	  DECLARE comprobarf INT DEFAULT 0;
	  DECLARE comprobario INT DEFAULT 0;
	  DECLARE comprobarfo INT DEFAULT 0;
	  DECLARE ID_ INT;
          DECLARE last_id INT;
	  DECLARE antes INT DEFAULT 0;
	  DECLARE despues INT DEFAULT 0;
          
          select count(*) into comprobari from negra;
	  select count(*) into comprobario from ocupación;
	  
	  select ID into ID_ from backupnegra where Código = OLD.Código;
          
	  INSERT INTO negra VALUES(null, OLD.Código, OLD.Altura, OLD.Anchura, OLD.Profundidad, OLD.Color, OLD.Placa_base, CURDATE(), OLD.Fecha_baja);
          
	  select Lejas_Ocupadas into antes from estanteria where estanteria.ID = '".$backup->getEstanteria()."';
	  UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='".$backup->getEstanteria()."';
	  select Lejas_Ocupadas into despues from estanteria where estanteria.ID = '".$backup->getEstanteria()."';
	            
          SELECT MAX(ID) into last_id FROM negra;
          INSERT INTO ocupación VALUES(null, '".$backup->getEstanteria()."', '".$backup->getLeja()."', last_id, 'caja_negra');
          
          select count(*) into comprobar1 from negra where Código = OLD.Código;
          
          select count(*) into comprobarf from negra;
	  select count(*) into comprobarfo from ocupación;
          
          if (comprobar1 = 0) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5013', MESSAGE_TEXT = 'error no existe la caja negra.';
	  end if;
          if (antes = despues) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5020', MESSAGE_TEXT = 'error al actualizar las lejas de la estanteria.';
	  end if;
          if (comprobari = comprobarf) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la caja negra.';
	  end if;
	  if (comprobario = comprobarfo) then
	  	SIGNAL SQLSTATE '75001' set MYSQL_ERRNO = '5005', MESSAGE_TEXT = 'no se ha borrado la ocupación.';
	  end if;
    end;";
    $resultado2=$conexion->query($triggerFuerte);