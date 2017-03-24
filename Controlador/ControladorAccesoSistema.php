<?php

    include_once '../DAO/Operaciones.php';
    /**
     * Recibiremos los datos del usuario y su contraseña, los mandaremos a una función
     * de la clase operaciones nos devolverá TRUE si ese usuario y contraseña existen 
     * en la BDD y en caso negativo nos mostrará una página para volver al acceso del sistema.
     */
    $usuario=$_REQUEST['usuario'];
    $contrasena=$_REQUEST['contrasena'];

    $salida = Operaciones::accesoSistema($usuario, $contrasena);
    
    if($salida){
        session_start();
        $_SESSION["user"]=$usuario;
        header("Location: ../Vistas/Menu.php");
    }else{
        session_start();
        $_SESSION["salida"]="Error al acceder al sistema, vuelva a intentarlo."
                           ."Usuario y/o contraseña incorrectas.";
        header("Location: ../Vistas/Salida.php");
    }