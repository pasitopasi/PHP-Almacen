<?php
/**
 * Aqui recibiremos los datos para introducir un usuario en el sistema.
 * Con estos datos, montaremos un objeto usuario, dicho objeto lo mandaremos 
 * a la clase operaciones y lo introducirá a la BDD.
 * Dicha operación nos devolverá un booleano que en caso de que sea TRUE nos dirigirá
 * al acceso del sistema, en caso negativo nos mostrará un mensaje y la posibilidad de volver a crear el usuario.
 */
    include_once '../Modelo/Usuario.php';
    include_once '../DAO/Operaciones.php';
    $nombre=$_REQUEST['nombre'];
    $apellido=$_REQUEST['apellido'];
    $usuario=$_REQUEST['usuario'];
    $contrasena=$_REQUEST['contrasena'];
    $personal = new Usuario($nombre, $apellido, $usuario, $contrasena);
    $salida = Operaciones::anadirUsuario($personal);
    if($salida){
        header("Location: ../Vistas/AccesoSistema.php");
    }else{
        session_start();
        $_SESSION["salida"]="Error al crear el usuario, vuelva a intentarlo.";
        header("Location: ../Vistas/Salida.php");
    }
    