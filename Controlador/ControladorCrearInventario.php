<?php
/**
 * Aquí crearemos una variable SESSION la cuál tiene como datos un objeto almacen,
 * el cuál se crea en la función de la clase operaciones.
 * Después redigiriremos a una vista que trata esa variable y nos la muestra.
 */
    session_start();
    include_once '../DAO/Operaciones.php';
    $arrinventario = Operaciones::MostrarEstanteriasOrden();
    $_SESSION["inventario"]=$arrinventario;
    header("Location: ../Vistas/ListadoInventario.php");