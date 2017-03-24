<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear usuario</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloAccesoSistema.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body onload="accion()">
        <form id="crearUsuario" name="crearUsuario" method="post" action="../Controlador/ControladorCrearUsuario.php">
            <h2>&nbsp;</h2>
            <table width="309"  align="center" id="tablaAcceso">
                <tr>
                    <td colspan="2" align="center"><h3><strong>Alta usuario</strong></h3></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><label><input name="nombre" type="text" id="nombre" /></label></td>
                </tr>
                <tr>
                    <th>Apellido</th>
                    <td><label><input name="apellido" type="text" id="apellido" /></label></td>
                </tr>
                <tr>
                    <th>Usuario</th>
                    <td><label><input name="usuario" type="text" id="usuario" /></label></td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td><label><input name="contrasena" type="password" id="contrasena" /></label></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><label><input type="button" name="Crear usuario" id="CrearUsuario" value="Crear Usuario" onclick="crearusuario()" /></label></td>
                </tr>
                
            </table>
            <p>&nbsp;</p>
            <p id="salida"></p>
            <div align="center" id="imagen1"></div>
        </form>
    </body>
</html>
