<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso al Sistema</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloAccesoSistema.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body>
        <form id="accesoSistema" name="accesoSistema" method="post" action="../Controlador/ControladorAccesoSistema.php">
            <h2>&nbsp;</h2>
            <table width="150"  align="center" id="tablaAcceso">
                <tr>
                    <td colspan="2" align="center"><h3><strong>Acceso Usuario</strong></h3></td>
                </tr>
                <tr>
                    <th>Usuario</th>
                    <td>
                        <label><input name="usuario" type="text" id="usuario" /></label>
                    </td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td>
                        <label><input name="contrasena" type="password" id="contrasena" /></label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label><input type="button" name="Acceder" id="Registrar" value="Acceder" onclick="accesosistema()"/></label>
                    </td>
                </tr>
            </table>
        </form>
        <h3>&nbsp;</h3>
        <div align="center" id="imagen"></div>
    </body>
</html>
