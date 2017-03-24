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
        <title>Resgistrar Estanterias</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloIntroducirEstanteria.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body>
        <form id="anadirEstante" name="anadirEstante" method="post" action="../Controlador/ControladorCrearEstanteria.php">
            <h2>&nbsp;</h2>
            <table>
                <tr>
                    <td colspan="2" align="center"><h3><strong>Introducir una estanteria</strong></h3></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <td><label><input name="codigo" type="text" id="codigo" /></label></td>
                </tr>
                <tr>
                    <th>Material</th>
                    <td><label><input name="material" type="text" id="material" /></label></td>
                </tr>
                <tr>
                    <th>Número de lejas</th>
                    <td><label><input name="l_ocupadas" type="text" id="l_ocupadas" /></label></td>
                </tr>
                <tr>
                    <th>Pasillo</th>
                    <td><label><input name="pasillo" type="text" id="pasillo" /></label></td>
                </tr>
                <tr>
                    <th>Número</th>
                    <td><label><input name="numero_p" type="text" id="numero_p" /></label></td>
                </tr>
     
                <tr>
                    <td colspan="2" align="center"><label><input type="button" name="Registrar" id="Registrar" value="Registrar" onclick="aceptarEstanteria()"/></label></td>
                </tr>
            </table>
            <p>&nbsp;</p>
        </form>
        <a href='Menu.php'>Menu Principal</a>
    </body>
</html>
<?php
}