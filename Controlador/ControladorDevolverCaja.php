<?php
/**
 * Este controlador recibirá el tipo y el código de la caja,
 * dependiendo de que tipo sea se irá a cada función. 
 * En dicha función devolverá un objeto backup de caja caja y lo 
 * meteremos en una variable SESSION.
 * Controlamos el caso de que la caja del tipo pasado y con ese código
 * no exista.
 * Si no existe mostramos una página con esa información y la posibilidad de volver atrás.
 * Si existe nos direcciona a otra página de confirmar devolución.
 */
    session_start();
    include_once '../DAO/Operaciones.php';
    include_once '../Modelo/BackupSorpresa.php';
    include_once '../Modelo/BackupNegra.php';
    include_once '../Modelo/BackupFuerte.php';
    $tipo = $_REQUEST['tipoc'];
    $codigo = $_REQUEST['codigo'];
    if($tipo=="caja_sorpresa"){
        $backup = Operaciones::sacarBackupSorpresa($codigo);
        if($backup==-1){
            $backup = Operaciones::sacarBackupSorpresaEspecial($codigo);
        }
        echo $backup;
        $_SESSION["backup"] = $backup;
    }
    if($tipo=="caja_fuerte"){
        $backup = Operaciones::sacarBackupFuerte($codigo);
        $_SESSION["backup"]=$backup;
    }
    if($tipo=="caja_negra"){
        $backup = Operaciones::sacarBackupNegra($codigo);
        $_SESSION["backup"]=$backup;
    }
    if($backup!=-1){
        header("Location: ../Vistas/ConfirmarDevolucion.php");
    }else{
        session_start();
        $_SESSION["salida"]="Error al buscar la caja.";
        header("Location: ../Vistas/Salida.php");
    }