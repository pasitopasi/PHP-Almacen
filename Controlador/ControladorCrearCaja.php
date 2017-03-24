<?php
/**
 * En este controlador recibiremos odos los datos del formulario
 * y dependiendo de que tipo sea, crearemos unos objetos cajasorpresa, fuerte o negra,
 * luego montaremos el objeto ocupación.
 * Tras montar los objetos, los mandaremos a las funciones y añadiremos esos objetos 
 * a la BDD.
 * Como en cada función nos devuelve un STRING con la información de salida, si se ha realizado
 * correctamente o no.
 * Lo mastraremos en un página a parte.
 */
    include '../Modelo/CajaFuerte.php';
    include '../Modelo/CajaNegra.php';
    include '../Modelo/CajaSorpresa.php';
    include '../Modelo/Ocupacion.php';
    include_once '../DAO/Operaciones.php';
    $tipo=$_REQUEST['tipoc'];
    $codigo=$_REQUEST['codigo'];
    $altura=$_REQUEST['altura'];
    $anchura=$_REQUEST['anchura'];
    $profundidad=$_REQUEST['profundidad'];
    $color=$_REQUEST["color"];
    $contenido_sorpresa=$_REQUEST['sor'];
    $devolucion=$_REQUEST['sor1'];
    $contenido_fuerte=$_REQUEST['fuer'];
    $contenido_negra=$_REQUEST['neg'];
    $id_estanteria=$_REQUEST["selectEstanteria"];
    $leja=$_REQUEST["lejas_libres"];
    if($tipo=="caja_sorpresa"){
        $sorpresa = new CajaSorpresa($codigo, $anchura, $altura, $profundidad, $color, $contenido_sorpresa, $devolucion);
        $ocupacion = new Ocupacion($id_estanteria, $leja, null, $tipo);
        $salida = Operaciones::anadirSorpresa($sorpresa, $ocupacion);
    }
    if($tipo=="caja_fuerte"){
        $fuerte = new CajaFuerte($codigo, $anchura, $altura, $profundidad, $color, $contenido_fuerte);
        $ocupacion = new Ocupacion($id_estanteria, $leja, null, $tipo);
        $salida = Operaciones::anadirFuerte($fuerte, $ocupacion);
        
    }
    if($tipo=="caja_negra"){
        $negra = new CajaNegra($codigo, $anchura, $altura, $profundidad, $color, $contenido_negra);
        $ocupacion = new Ocupacion($id_estanteria, $leja, null, $tipo);
        $salida = Operaciones::anadirNegra($negra, $ocupacion);
    }
    echo $sorpresa;
    session_start();
    $_SESSION["salida"]=$salida;
    header("Location: ../Vistas/Salida.php");