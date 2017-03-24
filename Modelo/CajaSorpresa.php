<?php
include_once 'Caja.php';

/**
 * Objeto CajaSorpresa, servirá para guardar datos de una CajaSorpresa, todos los
 * posibles datos de dicha caja.
 *
 * @author Alejandro
 */

class CajaSorpresa extends Caja{
    /**
     * Variable que guardará información relevante sobre el contenido de la CajaSorpresa.
     *
     * @var String 
     */
    private $contenido;
    private $devolucion;
    private $estanteria;
    /**
     * Constructor de la clase CajaSorpresa.
     * 
     * @param String $_codigo
     * @param int $_anchura
     * @param int $_altura
     * @param int $_profundidad
     * @param String $_color
     * @param String $_contenido
     */
    public function __construct($_codigo, $_anchura, $_altura, $_profundidad, $_color, $_contenido, $_devolucion) {
        parent::__construct($_codigo, $_anchura, $_altura, $_profundidad, $_color);
        $this->contenido=$_contenido;
        $this->devolucion=$_devolucion;
    }
    /**
     * Función para poner el contenido que tenga la CajaSorpresa.
     * 
     * @param String $_contenido
     */
    public function setContenido($_contenido) {
        $this->contenido=$_contenido;
    }
    public function setDevolucion($_devolucion) {
        $this->devolucion=$_devolucion;
    }
    public function setEstanteria($_devolucion) {
        $this->estanteria=$_devolucion;
    }
    /**
     * Función para devolver el contenido que tenga la CajaSorpresa.
     * 
     * @return String
     */
    public function getContenido() {
        return $this->contenido;
    }
    public function getDevolucion() {
        return $this->devolucion;
    }
    public function getEstanteria() {
        return $this->estanteria;
    }
    /**
     * Función para devolver la información de la CajaSorpresa.
     * 
     * @return String
     */
    public function __toString() {
        return parent::__toString()." Contenido: ".$this->contenido." Devolucion: ".$this->devolucion;
    }
}