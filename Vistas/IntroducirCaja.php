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
        <title>Introducir Caja</title>
        <script type="text/javascript" src="../JavaScript/java.js">
        </script>
        <script type="text/javascript" src="../JavaScript/jscolor.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloCajas.css" title="style" />
        <style type="text/css">
	</style>
    </head>
    <body onload="ocultacion()">
        <form id="crearCaja" name="crearCaja" method="post" action="../Controlador/ControladorCrearCaja.php">
            <h2>&nbsp;</h2>
            <table>
                <tr>
                    <th colspan="2" align="center"><h3><strong>Introducir caja</strong></h3></th>
                </tr>
                <tr>
                    <th>Tipo</th>
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
                    <th>Código</th>
                    <td><label><input name="codigo" type="text" id="codigo" /></label></td>
                </tr>
                <tr>
                    <th rowspan="4">Caracteristicas</th>
                    <td><label>Altura: <input name="altura" type="text" id="altura" size="8"/></label>
                        <label>Anchura: <input name="anchura" type="text" id="anchura" size="8"/></label>
                        <label>Profundidad: <input name="profundidad" type="text" id="profundidad" size="8" /></label>
                        <!-- EXPLICAR UN POCO SOBRE JSCOLOR
                        ---- 
                        -->
                        <label>Color: <input class="jscolor" name="color" id="color" size="8"/></label></td>
                </tr>
                <tr>
                    <td><label id="c_sorpresa">Contenido: <input name="sor" id="sor" type="text" /></label>
                        <label id="c_sorpresa1">No devolución: <input name="sor1" id="sor1" type="radio" value="0"/></label>
                        <label id="c_sorpresa2">Devolución: <input name="sor1" id="sor1" type="radio" value="1" checked="checked"/></label>
                    </td>
                </tr>
                <tr>
                    <td><label id="c_fuerte">Seguridad: <input name="fuer" id="fuer" type="text" /></label></td>
                </tr>
                <tr>
                    <td><label id="c_negra">Placa base: <input name="neg" id="neg" type="text" /></label></td>
                </tr>
                <tr>
                    <th>Ocupación</th>
                    <td>Estanteria: <label>
                            <select id="selectEstanteria" name="selectEstanteria" onchange="muestraLejas(this.value)">
                                <option value="null" selected="selected">- Elije estanteria -</option>
                                <?php
                                /* Obtenemos la conexión*/
                                include_once ("../DAO/ControladorConectorBDD.php");
                                /* Obtenemos  todas las estanterias*/
                                $consulta="SELECT * FROM estanteria";                
                                $resultado=$conexion->query($consulta);
                                if($resultado){
                                    $fila=$resultado->fetch_array();
                                    while($fila){
                                        if($fila['Numero_Lejas']!=$fila['Lejas_Ocupadas']){
                                            ?>
                                            <option value=<?php echo $fila['ID']?> ><?php echo $fila['Código']."  ".$fila['Material'] ?></option>
                                            <?php
                                        }
                                        $fila=$resultado->fetch_array();
                                    }
                                }
                                else{
                                    echo "<h1>SELECT NO POSIBLE</h1>";
                                }
                                # cerramos la conexion
                                $conexion->close();
                                ?>
                            </select>
                        </label>
                        Ocupacion leja: <label>
                            <select name="lejas_libres" id="lejas_libres">
                                <option value="null" selected="selected">- Elije Leja -</option>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" align="center"><label><input type="button" name="Registrar" id="Registrar" value="Registrar" onclick="cajita()" /></label></th>
                </tr>
            </table>
            <p>&nbsp;</p>
        </form>
        <a href='Menu.php'>Menu Principal</a>
    </body>
</html>
<?php
}