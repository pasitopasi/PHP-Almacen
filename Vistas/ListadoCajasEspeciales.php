<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require_once '../Modelo/CajaSorpresa.php';  
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }else{
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Especiales</title>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloInventario.css" title="style" />
        <style type="text/css"></style>
    </head>
    <body>
        <?php
            if(!isset($_SESSION["cajaEspecial"])){
                ?>
                    <h2>NO HAY DATOS EN LA VARIABLE SESSION, VUELVA AL MENÚ PRINCIPAL</h2>
                <?php
            }else{
                $arra = $_SESSION["cajaEspecial"];
                if($arra!=null){
                    ?>
                    <h1>&nbsp;</h1>
                    <h2>Cajas Sorpresa que no se pueden devolver</h2>
                    <h4>&nbsp;</h4>
                    <table border="1" cellspacing="1" cellpadding="5" bordercolor="666633" align="center">
                        <tr bgcolor="#FFC776">
                            <th>Estanteria</th>
                            <th>Leja</th>
                            <th>Caja</th>
                            <th>Código</th>
                            <th>Altura</th>
                            <th>Anchura</th>
                            <th>Profundidad</th>
                            <th>Color</th>
                            <th>Contenido</th>
                        </tr>
                        <?php       
        
                                foreach($arra as $caja){
                        ?>
                        <tr>
                            <td><?php echo $caja->getEstanteria() ?></td>
                            <td><?php echo $caja->getLeja()+1 ?></td>
                            <td>Sorpresa</td>
                            <td><?php echo $caja->getCodigo() ?></td>
                            <td><?php echo $caja->getAltura() ?></td>
                            <td><?php echo $caja->getAnchura() ?></td>
                            <td><?php echo $caja->getProfundidad() ?></td>
                            <td bgcolor="<?php echo $caja->getColor() ?>"><?php echo $caja->getColor() ?></td>
                            <td><?php echo $caja->getContenido() ?></td>
                        </tr>
                        <?php
                                }
                                unset($_SESSION["cajaEspecial"]);
                        ?>
                    </table>
                    <?php
                }else{
            ?>
                <h2>NO HAY DATOS EN EL ALMACÉN, VUELVA AL MENÚ PRINCIPAL</h2>
            <?php
                }
            }
        ?>
                <h1>&nbsp;</h1>
                <button><a href='Menu.php'>Menu Principal</a></button>
    </body>
</html>
<?php
    }
