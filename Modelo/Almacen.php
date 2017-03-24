<?php
include_once 'Inventario.php';

/**
 * Clase almacén, que servira para crear objetos almacen, que tendrá una fecha
 * y un array de inventario.
 *
 * @author Alejandro
 */

class Almacen {
    /**
     * String que guardará la fecha del dia.
     *
     * @var String 
     */
    private $fecha;
    /**
     * Array de inventario que será lo que contenga el almacén.
     *
     * @var array 
     */
    private $inventarios = array();
    /**
     * Constructor de la clase Almacen.
     * 
     * @param array $array
     */
    public function __construct($array) {
        $this->fecha=$this->getFecha();
        for($i=0; $i<count($array);$i++){
            array_push($this->inventarios, $array[$i]);
        }
    }
    /**
     * Fución que devovlerá el array de inventarios.
     * 
     * @return array
     */
    public function getInventario() {
        return $this->inventarios;
    }
    /**
     * Función que nos devolverá el tamaño del almacén.
     * 
     * @return int
     */
    public function getTamanoInventario(){
        return count($this->inventarios);
    }
    /**
     * Función que nos devolverá un Stirng que tendrá la fecha.
     * 
     * @return String
     */
    public function getFecha(){
        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $dia = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
        return $dia[date("N")-1].", ".date("d")." de ".$meses[date("n")-1]." de ".date("Y");
    }
    
}
