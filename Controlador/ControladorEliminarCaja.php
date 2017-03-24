<?php
/**
 * 
 */
    session_start();
    include_once '../DAO/Operaciones.php';
    include_once '../Modelo/BackupSorpresa.php';
    include_once '../Modelo/BackupNegra.php';
    include_once '../Modelo/BackupFuerte.php';
    $tipo = $_REQUEST['tipoc'];
    $codigo = $_REQUEST['codigo'];
    if($tipo=="caja_sorpresa"){
        $backup = Operaciones::datosSorpresa($codigo);
    }
    if($tipo=="caja_fuerte"){
        $backup = Operaciones::datosFuerte($codigo);
    }
    if($tipo=="caja_negra"){
        $backup = Operaciones::datosNegra($codigo);
    }
    if($backup!=-1){
        $_SESSION["backupBorrado"] = $backup;
        header("Location: ../Vistas/ConfirmarBorrado.php");
    }else{
        session_start();
        $_SESSION["salida"]="Error al buscar la caja.";
        header("Location: ../Vistas/Salida.php");
    }
