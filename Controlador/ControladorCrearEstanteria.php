<?php
/**
 * Aquí recibiremos los datos de una estanteria, montaremos un objeto estanteria
 * y la mandaremos a una función, la cuál introduce esos datos del objeto en la BDD.
 * Como dicha función nos devuelve un STRING informandonos de si se ha realizado
 * correctamente o no, redigiriremos a dicha pagina con ese STRING.
 */
    include '../Modelo/Estanteria.php';
    include_once '../DAO/Operaciones.php';
    $codigo=$_REQUEST['codigo'];
    $material=$_REQUEST['material'];
    $l_ocupadas=$_REQUEST['l_ocupadas'];
    $pasillo=$_REQUEST['pasillo'];
    $numero_p=$_REQUEST['numero_p'];
    $estan = new Estanteria($codigo, $material, $l_ocupadas, 0,$pasillo,$numero_p);
    $salida = Operaciones::anadirEstanteria($estan);
    session_start();
    $_SESSION["salida"]=$salida;
    header("Location: ../Vistas/Salida.php");