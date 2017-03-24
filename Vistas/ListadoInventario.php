<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require_once '../Modelo/Almacen.php';  
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }else{
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inventario</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloInventario.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body>
        </br>
        <?php
            if(!isset($_SESSION["inventario"])){
        ?>
            <h2 align="center">NO HAY DATOS EN LA VARIABLE SESSION, VUELVA AL MENÚ PRINCIPAL</h2>
        <?php
            }else{
                $almacen = $_SESSION["inventario"];
        ?>
            <h2 align="center">La fecha de Inventario: <?php echo $almacen->getFecha() ?></h2>
            <h1>&nbsp;</h1>
        <?php
                foreach($almacen->getInventario() as $inventario){
                    $estanteria = $inventario->getEstanteria();
                    if($estanteria!=null){
        ?>
            <table border="1" cellspacing="1" cellpadding="5" bordercolor="666633" align="center">
                <tr bgcolor="#45D5FF">
                    <th>Estanteria</th>
                    <th>Código</th>
                    <th>Material</th>
                    <th>Número de lejas</th>
                    <th>Lejas ocupadas</th>
                    <th>Pasillo</th>
                    <th>Número de pasillo</th>
                    <th rowspan="2" bgcolor="white"></th>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $estanteria->getCodigo() ?></td>
                    <td><?php echo $estanteria->getMaterial() ?></td>
                    <td><?php echo $estanteria->getNLejas() ?></td>
                    <td><?php echo $estanteria->getOLejas() ?></td>
                    <td><?php echo $estanteria->getPasillo() ?></td>
                    <td><?php echo $estanteria->getNumeroP() ?></td>
                </tr>
                <tr bgcolor="#FFC776">
                    <th>Leja</th>
                    <th>Caja</th>
                    <th>Código</th>
                    <th>Altura</th>
                    <th>Anchura</th>
                    <th>Profundidad</th>
                    <th>Color</th>
                    <th>Caracteristias</th>
                </tr>

        <?php       
        
                foreach($inventario->getCaja() as $caja){
                    if($caja instanceof CajaSorpresa){
        ?>
                <tr>
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
                    if($caja instanceof CajaNegra){
        ?>
                <tr>
                    <td><?php echo $caja->getLeja()+1 ?></td>
                    <td>Negra</td>
                    <td><?php echo $caja->getCodigo() ?></td>
                    <td><?php echo $caja->getAltura() ?></td>
                    <td><?php echo $caja->getAnchura() ?></td>
                    <td><?php echo $caja->getProfundidad() ?></td>
                    <td bgcolor="<?php echo $caja->getColor() ?>"><?php echo $caja->getColor() ?></td>
                    <td><?php echo $caja->getPlaca_base() ?></td>
                </tr>
        <?php
                    }
                    if($caja instanceof CajaFuerte){
        ?>
                <tr>
                    <td><?php echo $caja->getLeja()+1 ?></td>
                    <td>Fuerte</td>
                    <td><?php echo $caja->getCodigo() ?></td>
                    <td><?php echo $caja->getAltura() ?></td>
                    <td><?php echo $caja->getAnchura() ?></td>
                    <td><?php echo $caja->getProfundidad() ?></td>
                    <td bgcolor="<?php echo $caja->getColor() ?>"><?php echo $caja->getColor() ?></td>
                    <td><?php echo $caja->getSeguridad() ?></td>
                </tr>
        <?php
                    }
                }
        ?>
                <tr>
                <tr>
                    <td colspan="8"></td>
                </tr>
                </tr>
        <?php
        }else{
        ?>
            <h2 align="center">NO HAY DATOS EN EL ALMACÉN, VUELVA AL MENÚ PRINCIPAL</h2>
        <?php
        }
        }
        unset($_SESSION["inventario"]);
    }
        ?>
            </table>
            <h1>&nbsp;</h1>
            <button><a href='Menu.php'>Menu Principal</a></button>>
    </body>
</html>
<?php
    }