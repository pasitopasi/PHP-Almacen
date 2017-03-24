<?php
include_once 'Estanteria.php';
include_once 'CajaSorpresa.php';
include_once 'CajaFuerte.php';
include_once 'CajaNegra.php';

/**
 * Objeto Inventario, servirá para guardar datos de una estanteria junto al array de 
 * cajas que tenga. Será una clase "estanteria-caja".
 *
 * @author Alejandro
 */

class Inventario {
    /**
     * Variable que almacena el ID de la estanteria.
     *
     * @var int 
     */
    private $es;
    /**
     * Variable que almacena un array con todas las cajas que tenga esa estanteria.
     *
     * @var Caja 
     */
    private $cajas = array();
    /**
     * Constructor de la clase Inventario.
     * 
     * @param int $_estant
     * @param Caja $array
     */
    public function __construct($_estant, $array) {
        $this->es = $_estant;
        for($i=0; $i<count($array);$i++){
            array_push($this->cajas, $array[$i]);
        }
    }
    /**
     * Función para poner el ID de la estanteria.
     * 
     * @param int $param
     */
    public function setEstanteria($param) {
        $this->es=$param;
    }
    /**
     * Función para devolver el ID de la estanteria.
     * 
     * @return int
     */
    public function getEstanteria(){
        return $this->es;
    }
    /**
     * Función para devolver el array de cajas.
     * 
     * @return Caja
     */
    public function getCaja() {
        return $this->cajas;
    }
    /**
     * Función para devolver el tamaño del array de cajas.
     * 
     * @return int
     */
    public function getTamanoCajas(){
        return count($this->cajas);
    }
}
