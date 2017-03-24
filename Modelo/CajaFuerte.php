<?php
include_once 'Caja.php';

/**
 * Objeto CajaFuerte, servirá para guardar datos de una CajaFuerte, todos los
 * posibles datos de dicha caja.
 *
 * @author Alejandro
 */

class CajaFuerte extends Caja{
    /**
     * Variable que guardará información relevante sobre la seguridad de la CajaFuerte.
     *
     * @var String 
     */
    private $seguridad;
    /**
     * Constructor de la clase CajaFuerte.
     * 
     * @param String $_codigo
     * @param int $_anchura
     * @param int $_altura
     * @param int $_profundidad
     * @param String $_color
     * @param String $_seguridad
     */
    public function __construct($_codigo, $_anchura, $_altura, $_profundidad, $_color, $_seguridad) {
        parent::__construct($_codigo, $_anchura, $_altura, $_profundidad, $_color);
        $this->seguridad=$_seguridad;
    }
    /**
     * Función para poner la seguridad que tenga la CajaFuerte.
     * 
     * @param String $_seguridad
     */
    public function setSeguridad($_seguridad) {
        $this->seguridad=$_seguridad;
    }
    /**
     * Función para devolver la seguridad que tenga la CajaFuerte.
     * 
     * @return String
     */
    public function getSeguridad() {
        return $this->seguridad;
    }
    /**
     * Función para devolver la información de la CajaFuerte.
     * 
     * @return String
     */
    public function __toString() {
        return parent::__toString()." Seguridad: ".$this->seguridad;
    }
}
