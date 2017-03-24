<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eliminar Caja</title>
        <link rel="stylesheet" type="text/css" href="../CSS/EstiloBorrado.css" title="style" />
    </head>
    <body>
        <h2>&nbsp;</h2>
        <?php
        require_once '../Modelo/BackupSorpresa.php'; 
        require_once '../Modelo/BackupFuerte.php';  
        require_once '../Modelo/BackupNegra.php';  
        session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }else{
        $backup = $_SESSION["backupBorrado"];
        
        if($backup instanceof BackupSorpresa){
            $tipo="Caja Sorpresa";
            $caja = $backup->getSorpresa();
            
            $codigo = $caja->getCodigo();
            $altura = $caja->getAltura();
            $anchura = $caja->getAnchura();
            $profundidad = $caja->getProfundidad();
            $color = $caja->getColor();
            $conenido = $caja->getContenido();
            $devolucion = $caja->getDevolucion();
            
            $estanteria=$backup->getEstanteria();
            $leja=$backup->getLeja();
            ?>
        <form id="form4" name="form1" method="post" action="../Controlador/ControladorEliminarConfirmado.php">
            <table >
                <tr>
                    <td colspan="2" align="center"><h3><strong>Confirmar la extracción de caja</strong></h3></td>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td><?php echo $tipo ?></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <td><?php echo $codigo ?></td>
                </tr>
                <tr>
                    <th rowspan="2">Caracteristicas</th>
                    <td><label>Altura: <input readonly="readonly" type="text" name="altura" value="<?php echo $altura ?>" size="2"/></label>
                       <label>Anchura: <input readonly="readonly" type="text" name="anchura" value="<?php echo $anchura ?>" size="2"/></label>
                        <label>Profundidad: <input readonly="readonly" type="text" name="profundidad" value="<?php echo $profundidad ?>" size="2"/></label>
                        <label>Color: <input readonly="readonly" type="text" name="profundidad" value="<?php echo $color ?>" size="4" style=" background-color: #<?php echo $color ?>" /></label></td>
                </tr>
                <tr>
                    <td><label>Contenido: "<?php echo $conenido ?>"</label>
                        <label>&nbsp;&nbsp;Devolución: 
                            <?php 
                                if($devolucion==0){
                                    echo "no";
                                }else{
                                    echo "si";
                                }
                            ?>
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th>Ocupación</th>
                    <td>Estanteria: <?php 
                        include_once ("../DAO/ControladorConectorBDD.php");
                        /* Obtenemos  todas las estanterias*/
                        $consulta="SELECT * FROM estanteria where ID = $estanteria";                
                        $resultado=$conexion->query($consulta);
                        if($resultado){
                            $fila=$resultado->fetch_array();
                            echo $fila['Código'];
                        }
                        ?>
                        Leja: <?php echo $leja+1 ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label><a href="EliminarCaja.php"><input type="button" name="Cancelar" id="atras" value="Cancelar" /></a></label>
                        <label><input type="submit" name="Borrar" id="Borrar" value="Extraer" /></label>
                    </td>
                </tr>
            </table>
            </form>
        
        <?php
        } 
        
        if($backup instanceof BackupFuerte){
            $tipo="Caja Fuerte";
            $caja = $backup->getFuerte();
            
            $codigo = $caja->getCodigo();
            $altura = $caja->getAltura();
            $anchura = $caja->getAnchura();
            $profundidad = $caja->getProfundidad();
            $color = $caja->getColor();
            $conenido = $caja->getSeguridad();
            
            $estanteria=$backup->getEstanteria();
            $leja=$backup->getLeja();
            ?>
        <form id="form5" name="form1" method="post" action="../Controlador/ControladorEliminarConfirmado.php">
            <table width="750" border="1" align="center">
                <tr>
                    <td colspan="2" align="center"><h3><strong>Confirmar eliminación de caja</strong></h3></td>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td><?php echo $tipo ?></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <td><?php echo $codigo ?></td>
                </tr>
                <tr>
                    <th rowspan="2">Caracteristicas</th>
                    <td><label>Altura: <input readonly="readonly" type="text" name="altura" value="<?php echo $altura ?>" size="2"/></label>
                        <label>Anchura: <input readonly="readonly" type="text" name="anchura" value="<?php echo $anchura ?>" size="2"/></label>
                        <label>Profundidad: <input readonly="readonly" type="text" name="profundidad" value="<?php echo $profundidad ?>" size="2"/></label>
                        <label>Color: <input readonly="readonly" type="text" name="profundidad" value="<?php echo $color ?>" size="4" style=" background-color: #<?php echo $color ?>"/></label></td>
                </tr>
                <tr>
                    <td>Seguridad: <?php echo $conenido ?></td>
                </tr>
                
                <tr>
                    <th>Ocupación</th>
                    <td>Estanteria: <?php 
                        include_once ("../DAO/ControladorConectorBDD.php");
                        /* Obtenemos  todas las estanterias*/
                        $consulta="SELECT * FROM estanteria where ID = $estanteria";                
                        $resultado=$conexion->query($consulta);
                        if($resultado){
                            $fila=$resultado->fetch_array();
                            echo $fila['Código'];
                        }?>
                        Leja: <?php echo $leja+1 ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label><a href="EliminarCaja.php"><input type="button" name="Cancelar" id="atras" value="Cancelar" /></a></label>
                        <label><input type="submit" name="Borrar" id="Borrar" value="Borrar" /></label>
                    </td>
                </tr>
            </table>
            </form>
        
        <?php
        }
        if($backup instanceof BackupNegra){
            $tipo="Caja Negra";
            $caja = $backup->getNegra();
            
            $codigo = $caja->getCodigo();
            $altura = $caja->getAltura();
            $anchura = $caja->getAnchura();
            $profundidad = $caja->getProfundidad();
            $color = $caja->getColor();
            $conenido = $caja->getPlaca_base();
            
            $estanteria=$backup->getEstanteria();
            $leja=$backup->getLeja();
            ?>
                <form id="form6" name="form1" method="post" action="../Controlador/ControladorEliminarConfirmado.php">
            <table width="750" border="1" align="center">
                <tr>
                    <td colspan="2" align="center"><h3><strong>Confirmar eliminación de caja</strong></h3></td>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td><?php echo $tipo ?></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <td><?php echo $codigo ?></td>
                </tr>
                <tr>
                    <th rowspan="2">Caracteristicas</th>
                    <td><label>Altura: <input readonly="readonly" type="text" name="altura" value="<?php echo $altura ?>" size="2"/></label>
                        <label>Anchura: <input readonly="readonly" type="text" name="anchura" value="<?php echo $anchura ?>" size="2"/></label>
                        <label>Profundidad: <input readonly="readonly" type="text" name="profundidad" value="<?php echo $profundidad ?>" size="2"/></label>
                        <label>Color: <input readonly="readonly" type="text" name="profundidad" value="<?php echo $color ?>" size="4" style=" background-color: #<?php echo $color ?>"/></label></td>
                </tr>
                <tr>
                    <td>Placa Base: <?php echo $conenido ?></td>
                </tr>
                
                <tr>
                    <th>Ocupación</th>
                    <td>Estanteria: <?php 
                        include_once ("../DAO/ControladorConectorBDD.php");
                        /* Obtenemos  todas las estanterias*/
                        $consulta="SELECT * FROM estanteria where ID = $estanteria";                
                        $resultado=$conexion->query($consulta);
                        if($resultado){
                            $fila=$resultado->fetch_array();
                            echo $fila['Código'];
                        }?>
                        Leja: <?php echo $leja+1 ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label><a href="EliminarCaja.php"><input type="button" name="Cancelar" id="atras" value="Cancelar" /></a></label>
                        <label><input type="submit" name="Borrar" id="Borrar" value="Borrar" /></label>
                    </td>
                </tr>
            </table>
            </form>
        
        <?php
        }
        
        ?>
    </body>
</html>
<?php
    }