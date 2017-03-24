<?php

    $borrar="DROP TRIGGER IF EXISTS backupsorpresa_after_delete";
    $resultado3=$conexion->query($borrar);
    
    $triggerSorpresa="
          CREATE TRIGGER backupsorpresa_after_delete AFTER DELETE ON backupsorpresa FOR EACH ROW 
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
          
          select count(*) into comprobari from sorpresa;
	  select count(*) into comprobario from ocupación;
	  
	  select ID into ID_ from backupsorpresa where Código = OLD.Código;
          
	  INSERT INTO sorpresa VALUES(null, OLD.Código, OLD.Altura, OLD.Anchura, OLD.Profundidad, OLD.Color, OLD.Contenido, CURDATE(), OLD.Fecha_baja, 1);
          
	  select Lejas_Ocupadas into antes from estanteria where estanteria.ID = '".$estan."';
	  UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='".$estan."';
	  select Lejas_Ocupadas into despues from estanteria where estanteria.ID = '".$estan."';
	  
          SELECT MAX(ID) into last_id FROM sorpresa;
          INSERT INTO ocupación VALUES(null, '".$estan."', '".$lejita."', last_id, 'caja_sorpresa');
              
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
    end;";
    $resultado2=$conexion->query($triggerSorpresa);            