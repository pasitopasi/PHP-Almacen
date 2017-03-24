<?php
include_once 'ExceptionCaja.php';

/**
 * Objeto Caja, servirá para guardar datos de una Caja, todos los
 * posibles datos de dicha caja.
 *
 * @author Alejandro
 */

abstract class Caja {
    /**
     * Variable que guarda el ID de la caja.
     *
     * @var int 
     */
    private $ID;
    /**
     * Variable que almacena la leja donde está la caja.
     *
     * @var int 
     */
    private $leja;
    /**
     * Variable que guarda el código de la Caja que tendrá en el sistema.
     *
     * @var int 
     */
    private $codigo;
    /**
     * Variable que guarda la altura de la Caja.
     *
     * @var int 
     */
    private $anchura;
    /**
     * Variable que guarda la anchura de la Caja.
     *
     * @var int 
     */
    private $altura;
    /**
     * Variable que guarda la profundidad de la Caja.
     *
     * @var int 
     */
    private $profundidad;
    /**
     * Variable que guarda el color de la Caja.
     *
     * @var String 
     */
    private $color;
    /**
     * Constructor de la clase Caja.
     * 
     * @param String $_codigo
     * @param int $_anchura
     * @param int $_altura
     * @param int $_profundidad
     * @param String $_color
     */
    public function __construct($_codigo, $_anchura, $_altura, $_profundidad, $_color) {
        $this->codigo=$_codigo;
        $this->setanchura($_anchura);
        $this->setaltura($_altura);
        $this->setprofundidad($_profundidad);
        $this->color=$_color;
    }
    /**
     * Función para poner el código de la Caja.
     * 
     * @param String $_codigo
     */
    public function setCodigo($_codigo) {
        $this->codigo=$_codigo;
    }
    /**
     * Función para poner la altura de la Caja.
     * 
     * @param int $_altura
     * @throws ExceptionCaja
     */
    public function setaltura($_altura){
        if($_altura<0){
            throw new ExceptionCaja(" altura ",1, $_altura);
        }
        if($_altura==0){
            throw new ExceptionCaja(" altura ",2, $_altura);
        }
        if($_altura>150){
            throw new ExceptionCaja(" altura ",3, $_altura);
        }
        $this->altura=$_altura;
    }
    /**
     * Función para poner la anchura de la Caja.
     * 
     * @param int $_anchura
     * @throws ExceptionCaja
     */
    public function setanchura($_anchura){
        if($_anchura<0){
            throw new ExceptionCaja(" anchura ",1, $_anchura);
        }
        if($_anchura==0){
            throw new ExceptionCaja(" anchura ",2, $_anchura);
        }
        if($_anchura>150){
            throw new ExceptionCaja(" anchura ",3, $_anchura);
        }
        $this->anchura=$_anchura;
    }
    /**
     * Función para poner la profundidad de la Caja.
     * 
     * @param int $_profundidad
     * @throws ExceptionCaja
     */
    public function setprofundidad($_profundidad){
        if($_profundidad<0){
            throw new ExceptionCaja(" profundidad ",1, $_profundidad);
        }
        if($_profundidad==0){
            throw new ExceptionCaja(" profundidad ",2, $_profundidad);
        }
        if($_profundidad>150){
            throw new ExceptionCaja(" profundidad ",3, $_profundidad);
        }
        $this->profundidad=$_profundidad;
    }
    /**
     * Función para poner el color de la Caja.
     * 
     * @param String $_color
     */
    public function setcolor($_color){
        $this->color=$_color;
    }
    /**
     * Función para poner el ID de la Caja.
     * 
     * @param int $_ID
     */
    public function setID($_ID) {
        $this->ID=$_ID;
    }
    /**
     * Función para poner la leja de la Caja.
     * 
     * @param int $_leja
     */
    public function setLeja($_leja) {
        $this->leja = $_leja;
    }
    /**
     * Función para devolver el código de la Caja.
     * 
     * @return String
     */
    public function getCodigo(){
        return $this->codigo;
    }
    /**
     * Función para devolver la altura de la Caja.
     * 
     * @return int
     */
    public function getAltura(){
        return $this->altura;
    }
    /**
     * Función para devolver la anchura de la Caja.
     * 
     * @return int
     */
    public function getAnchura(){
        return $this->anchura;
    }
    /**
     * Función para devolver la profundidad de la Caja.
     * 
     * @return int
     */
    public function getProfundidad(){
        return $this->profundidad;
    }
    /**
     * Función para devolver el color de la Caja.
     * 
     * @return String
     */
    public function getColor(){
        return $this->color;
    }
    /**
     * Función para devolver el ID de la Caja.
     * 
     * @return int
     */
    public function getID() {
        return $this->ID;
    }
    /**
     * Función para devolver la leja de la Caja.
     * 
     * @return int
     */
    public function getLeja(){
        return $this->leja;
    }
    /**
     * Función para devolver la información de la Caja.
     * 
     * @return String
     */
    public function __toString() {
        return "Código: ".$this->codigo." Altura: ".$this->altura." Anchura: ".$this->anchura." Profundidad: ".$this->profundidad." Color: ".$this->color;
    }
}
