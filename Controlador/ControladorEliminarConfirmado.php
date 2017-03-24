<?php
/**
 * 
 */
    require_once '../Modelo/BackupSorpresa.php';    
    require_once '../Modelo/BackupFuerte.php';    
    require_once '../Modelo/BackupNegra.php';  
    session_start();
    include_once '../DAO/Operaciones.php';
    $backup=$_SESSION["backupBorrado"];
    if($backup instanceof BackupSorpresa){
        if($backup->getDevolucion()==0){
            $salida = Operaciones::insertarSorpresaBackupEspecial($backup);
        }else{
            $salida = Operaciones::insertarSorpresaBackup($backup);
        }
    }
    if($backup instanceof BackupFuerte){
        $salida = Operaciones::insertarFuerteBackup($backup);
    }
    if($backup instanceof BackupNegra){
        $salida = Operaciones::insertarNegraBackup($backup);
    }
    unset($_SESSION["backupBorrado"]);
    session_start();
    $_SESSION["salida"]=$salida;
    header("Location: ../Vistas/Salida.php");