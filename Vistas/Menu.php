<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }else{
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Página Principal</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/Estilo.css" title="style" />
        <style type="text/css">
            #header{
                    position: absolute;
                    margin-left: 90%;
                    margin-top: -120px;
            }
            * {
                    margin:0px;
                    padding:0px;
            }

            ul, ol {
                    list-style:none;
            }

            .nav > li {
                    float:left;
            }

            .nav li a {
                    background-color:#2175bc;
                    color:#fff;
                    text-decoration:none;
                    padding:10px 12px;
                    display:block;
            }
            .nav li a:hover {
                    background-color:#2586d7;
            }
            .nav li ul {
                    display:none;
                    position:absolute;
                    min-width:100px;
            }
            .nav li:hover > ul {
                    display:block;
            }
            .nav li ul li {
                    position:relative;
            }
	</style>
    </head>
    <body onload="nobackbutton()">
        <br>
        <h1>ALMACÉN</h1>
        <div class="menu">
            <ul class="inicio">
                <li><a onclick="clickEstanteria()">Estanterias</a></li>
                <li><a onclick="clickCajas()">Cajas</a></li>
                <li><a onclick="clickAlmacen()">Almacén</a></li>
            </ul>
        </div>
        <div class="menu1">
            
            <a id="u1" href="IntroducirEstanterias.php">Introducir estanteria en la Base de Datos</a>
            
            <a id="c1" href="IntroducirCaja.php">Introducir caja en la Base de Datos</a>
            
            <a id="a1" href="../Controlador/ControladorMostrarEstanterias.php">Mostrar estanterias del almacén</a>
            <a id="a2" href="../Controlador/ControladorCrearInventario.php">Mostrar inventario</a>
            <a id="a3" href="EliminarCaja.php">Sacar caja</a>
            <a id="u2" href="DevolverCaja.php">Devolver caja</a>
            <a id="u3" href="../Controlador/ControladorMostrarCSEspeciales.php">Caja sorpresas especiales</a>
        </div>
        <div id="header">
            <ul class="nav">
                <li><a href="">Usuario: <?php echo $_SESSION["user"]?></a>
                    <ul>
                        <li><a href="../index.php">Desconectar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </body>
</html>
<?php
}