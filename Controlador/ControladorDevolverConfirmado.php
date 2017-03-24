<?php
/**
 * Junto a los nuevos valores de Estanteria y leja, se los introducimos al objeto
 * y lo mandamos a la clase operaciones apra borrarlo.
 */
    require_once '../Modelo/BackupSorpresa.php';    
    require_once '../Modelo/BackupFuerte.php';    
    require_once '../Modelo/BackupNegra.php';  
    session_start();
    include_once '../DAO/Operaciones.php';
    $backup=$_SESSION["backup"];
    $id_estanteria=$_REQUEST["selectEstanteria"];
    $leja=$_REQUEST["lejas_libres"];
    $backup->setEstanteria($id_estanteria);
    $backup->setLeja($leja);
    if($backup instanceof BackupSorpresa){
        $salida = Operaciones::borrarBackupSorpresa($backup);
    }
    if($backup instanceof BackupFuerte){
        $salida = Operaciones::borrarBackupFuerte($backup);
    }
    if($backup instanceof BackupNegra){
        $salida = Operaciones::borrarBackupNegra($backup);
    }
    unset($_SESSION["backup"]);
    session_start();
    $_SESSION["salida"]=$salida;
    header("Location: ../Vistas/Salida.php");