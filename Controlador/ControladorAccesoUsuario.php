<?php
/**
 * Este será el primer controlador que se ejecue en el sistema, llamando a esa función
 * de la clase operaciones, nos devolverá TRUE en caso de que haya un usuario logueado,
 * en caso negativo nos mandará a una vista para crear un usuario.
 */
    include_once '../DAO/Operaciones.php';
    
    if(Operaciones::ComprobacioUsuario()){
        header("Location: ../Vistas/AccesoSistema.php");
    }else{
        header("Location: ../Vistas/CrearUsuario.php");
    }