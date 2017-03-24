<?php

/**
 * Objeto Ocupacion, servirá para guardar datos de la ocupacion de una Caja.
 *
 * @author Alejandro
 */

class Ocupacion {
    /**
     * Variable que almacena el ID de la estanteria.
     *
     * @var int 
     */
    private $id_estanteria; 
    /**
     * Variable que almacena la leja donde se encunetra la caja.
     *
     * @var int 
     */
    private $leja; 
    /**
     * Variable que almacena el ID de la caja.
     *
     * @var int 
     */
    private $id_caja; 
    /**
     * Variable que almacena el tipo de caja que es la caja.
     *
     * @var String 
     */
    private $tipo_caja; 
    /**
     * Constructor de la clase Ocupacion.
     * 
     * @param int $_id_estanteria
     * @param int $_leja
     * @param int $_id_caja
     * @param String $_tipo_caja
     */
    function __construct($_id_estanteria, $_leja, $_id_caja, $_tipo_caja) {
        $this->id_estanteria = $_id_estanteria;
        $this->id_caja = $_id_caja;
        $this->leja = $_leja;
        $this->tipo_caja = $_tipo_caja;
    }
    /**
     * Función que devuelve el ID de la estanteria.
     * 
     * @return int
     */
    function getID_Estanteria() {
        return $this->id_estanteria;
    }
    /**
     * Función que devuelve el ID de la caja.
     * 
     * @return int
     */
    function getID_Caja() {
        return $this->id_caja;
    }
    /**
     * Función que devuelve la leja donde se encuentra la caja.
     * 
     * @return int
     */
    function getLeja() {
        return $this->leja;
    }
    /**
     * Función que devuelve el tipo de la caja.
     * 
     * @return String
     */
    function getTipo_Caja() {
        return $this->tipo_caja; 
    }
    /**
     * Función para poner el ID de la estanteria.
     * 
     * @param int $_id_estanteria
     */
    function setID_Estanteria($_id_estanteria) {
        $this->id_estanteria = $_id_estanteria;
    }
    /**
     * Función para poner el ID de la caja.
     * 
     * @param int $_id_caja
     */
    function setID_Caja($_id_caja) {
        $this->id_caja = $_id_caja;
    }
    /**
     * Función para poner la leja donde se encuentra la caja.
     * 
     * @param int $_leja
     */
    function setLeja($_leja) {
        $this->leja = $_leja;
    }
    /**
     * Función para poner el tipo de la caja.
     * 
     * @param int $_tipo_caja
     */
    function setTipo_Caja($_tipo_caja) {
        $this->tipo_caja = $_tipo_caja;
    }
    /**
     * Función para devolver la información de la ocupacin de la caja.
     * 
     * @return String
     */
    function __toString() {
        return "La caja ".$this->tipo_caja." con ID ".$this->id_caja." ocupa la leja ".$this->leja." de la estanteria ".$this->id_estanteria;
    }
}
