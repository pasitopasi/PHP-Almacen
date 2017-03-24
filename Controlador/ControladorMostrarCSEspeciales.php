<?php
    session_start();
    include_once '../DAO/Operaciones.php';
    $arrayCS = Operaciones::listadoCajasEspeciales();
    $_SESSION["cajaEspecial"]=$arrayCS;
    header("Location: ../Vistas/ListadoCajasEspeciales.php");
