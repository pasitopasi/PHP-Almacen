<?php
/**
 * Crearemos una variable SESSION en la cuál almacenaremos un array de estanterias, 
 * dicho array no lo creará la función de la clase operaciones.
 * Al final, nos redigirá a la vista de listado de estanterias.
 */
    session_start();
    include_once '../DAO/Operaciones.php';
    $arrayEstan = Operaciones::listadoEstanterias();
    $_SESSION["arrayE"]=$arrayEstan;
    header("Location: ../Vistas/ListadoEstanteria.php");
    

