<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        include_once '../DAO/Operaciones.php';
        $idEstanteria= $_REQUEST["selectEstanteria"];
        
        $arrayLibres = Operaciones::verlejasEstanteria($idEstanteria);
        
        for($f=0;$f<count($arrayLibres);$f++)  {
        ?>
            <option value="<?php echo $arrayLibres[$f]?>"> <?php echo $arrayLibres[$f]+1?> </option>
        <?php
        }
        ?>
    </body>
</html>
