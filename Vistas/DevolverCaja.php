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
        <title>Devolver Caja</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloEliminar.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body>
        <form id="devolverCaja" name="devolverCaja" method="post" action="../Controlador/ControladorDevolverCaja.php">
                    <h2>&nbsp;</h2>
                    <img id="img1"src="../Imagenes/pregunta.png"/>
                    <img id="img2"src="../Imagenes/carton.png"/>
                    <table>
                        <tr>
                            <td colspan="2" align="center"><h3><strong>Devolver caja</strong></h3></td>
                        </tr>
                        <tr>
                            <td>Tipo</td>
                            <td><label>
                                    <select name="tipoc" id="tipoc" onchange="cambio()">
                                                        <option selected="selected" >- Seleccione caja -</option>
                                                        <option value="caja_sorpresa">Caja Sorpresa</option>
                                                        <option value="caja_fuerte">Caja Fuerte</option>
                                                        <option value="caja_negra">Caja Negra</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Código</td>
                            <td>
                                <label><input name="codigo" type="text" id="codigo" /></label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <label><input type="button" name="Buscar" id="Registrar" value="Buscar" onclick="devolverC();"/></label>
                            </td>
                        </tr>
                    </table>
        </form>
        <h2>&nbsp;</h2>
                    <a href='../Vistas/Menu.php'>Menu Principal</a>
    </body>
</html>
<?php
}