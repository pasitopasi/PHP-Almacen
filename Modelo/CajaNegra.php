<?php
include_once 'Caja.php';

/**
 * Objeto CajaNegra, servirá para guardar datos de una CajaNegra, todos los
 * posibles datos de dicha caja.
 *
 * @author Alejandro
 */

class CajaNegra extends Caja{
    /**
     * Variable que guardará información relevante sobre la placa base de la CajaNegra.
     *
     * @var String 
     */
    private $placa_base;
    /**
     * Constructor de la clase CajaNegra.
     * 
     * @param String $_codigo
     * @param int $_anchura
     * @param int $_altura
     * @param int $_profundidad
     * @param String $_color
     * @param String $_placa_base
     */
    public function __construct($_codigo, $_anchura, $_altura, $_profundidad, $_color, $_placa_base) {
        parent::__construct($_codigo, $_anchura, $_altura, $_profundidad, $_color);
        $this->placa_base=$_placa_base;
    }
    /**
     * Función para poner la placa base que tenga la CajaNegra.
     * 
     * @param String $_placa_base
     */
    public function setPlaca_base($_placa_base) {
        $this->placa_base=$_placa_base;
    }
    /**
     * Función para devolver la placa base que tenga la CajaNegra.
     * 
     * @return String
     */
    public function getPlaca_base() {
        return $this->placa_base;
    }
    /**
     * Función para devolver la información de la CajaNegra.
     * 
     * @return String
     */
    public function __toString() {
        return parent::__toString()." Placa base: ".$this->placa_base;
    }
}
