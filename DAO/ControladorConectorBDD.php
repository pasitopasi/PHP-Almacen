<?php
//      Establecemos la conexión con el servidor
    $conexion= new mysqli("localhost","root","root");
    if($conexion){ 
//      Seleccionamos la base de datos utilizada
        $conexion->select_db ("bd_almacen_amr");
    }
        