<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Estanterias</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloListadoEstanteria.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body>
        <h2>&nbsp;</h2>
        <?php
    require_once '../Modelo/Estanteria.php';  
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }else{
            if(!isset($_SESSION["arrayE"])){
                ?>
        <h1>NO HAY DATOS EN LA VARIABLE SESSION, VUELVA AL MENÚ PRINCIPAL</h1>
        <?php
            }else{
            $arra = $_SESSION["arrayE"];
            if($arra!=null){
        ?>
        <br>
        <table>
            <tr>
                <th>Código</th>
                <th>Material</th>
                <th>Número de lejas</th>
                <th>Lejas ocupadas</th>
                <th>Pasillo</th>
                <th>Número de pasillo</th>
            </tr>
            <?php
                foreach ($arra as $estanteria){
            ?>
            <tr>
                <td><?php echo $estanteria->getCodigo() ?></td>
                <td><?php echo $estanteria->getMaterial() ?></td>
                <td><?php echo $estanteria->getNLejas() ?></td>
                <td><?php echo $estanteria->getOLejas() ?></td>
                <td><?php echo $estanteria->getPasillo() ?></td>
                <td><?php echo $estanteria->getNumeroP() ?></td>
            </tr>
            <?php
                }
                unset($_SESSION["arrayE"]);
            }else{
            ?>
                <h1>NO HAY DATOS EN EL ALMACÉN, VUELVA AL MENÚ PRINCIPAL</h1>
            <?php
            }
            }
            ?>
        </table>
        <h2>&nbsp;</h2>
        <button><a href='Menu.php'>Menu Principal</a></button>
    </body>
</html>
<?php
    }