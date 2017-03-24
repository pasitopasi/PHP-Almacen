<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Información</title>
        <style type="text/css">
            body{
                text-align: center;
                background-color: #E0F8F7;
            }
            a{
                padding: 5px;
                text-decoration: none;
                color:black;
                font-size: 20px;
                background-color: #ff9933;
                border: 3px solid brown;
                border-radius: 20px;
            }
            h2{
                margin:0 auto;
                width: 450px;
                height: auto;
                background-color: black;
                color: white;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        if(!isset($_SESSION["salida"])){
        ?>
            <h2>No hay datos para mostrar, vuelva al menú principal.</h2>
        <?php
        }else{
            $salida=$_SESSION["salida"];
            if($salida==1){
            ?>
                <h1>Operación realizada correctamente.</h1>
            <?php
            }else{
            ?>
                <h2><?php echo $salida ?></h2>
            <?php
            }
            unset($_SESSION["salida"]);
        }
        ?>
        <br>
        <a href='../Vistas/Menu.php'>Menu Principal</a>
    </body>
</html>
