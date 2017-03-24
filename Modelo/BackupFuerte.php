<?php
include_once 'CajaFuerte.php';

/**
 * Objeto BackupFuerte, servirá para guardar datos de una Caja Fuerte, todos los
 * posibles datos de dicha caja, tanto su objeto como su ocupación.
 *
 * @author Alejandro
 */

class BackupFuerte extends CajaFuerte{
    /**
     * Variable que servirá para almacenar el objeto Caja Fuerte.
     *
     * @var CajaFuerte 
     */
    private $fuerte;
        /**
     * Variable que servirá para almacenar el ID de la estanteria donde se 
     * encuentre la caja.
     *
     * @var int 
     */
    private $estanteria;
    /**
     * Variable que servirá para almacenar la leja donde se encuentre la caja.
     *
     * @var int 
     */
    private $leja;
    /**
     * Constructor de la clase BackupFuerte.
     * 
     * @param CajaFuerte $_caja
     * @param type $_codigoEstanteria
     * @param type $_leja
     */
    function __construct($_caja, $_codigoEstanteria, $_leja) {
        parent::__construct($_caja->getCodigo(), $_caja->getAnchura(),$_caja->getAltura(), $_caja->getProfundidad(), $_caja->getColor(),$_caja->getSeguridad());
        $this->fuerte=$_caja;
        $this->estanteria=$_codigoEstanteria;
        $this->leja=$_leja;
    }
    /**
     * Para poner la Caja Fuerte.
     * 
     * @param CajaFuerte $_caja
     */
    function setFuerte($_caja){
        $this->fuerte=$_caja;
    }
    /**
     * Para poner el ID de la estanteria donde se encuentre la Caja Fuerte.
     * 
     * @param int $_codigoEstanteria
     */
    function setEstanteria($_codigoEstanteria){
        $this->estanteria=$_codigoEstanteria;
    }
    /**
     * Para poner la leja donde este la Caja Fuerte.
     * 
     * @param int $_leja
     */
    function setLeja($_leja){
        $this->leja=$_leja;
    }
    /**
     * Nos devuelve el objeto Caja Fuerte del que tenemos el backup.
     * 
     * @return CajaFuerte
     */
    function getFuerte(){
        return $this->fuerte;
    }
    /**
     * Nos devuelve el ID de la estanteria donde se encontraba la Caja Fuerte.
     * 
     * @return int
     */
    function getEstanteria(){
        return $this->estanteria;
    }
    /**
     * Nos devuelve la leja donde estaba la Caja Fuerte.
     * 
     * @return int
     */
    function getLeja(){
        return $this->leja;
    }
    /**
     * Pequeño String que nos informa de la Caja Fuerte.
     * 
     * @return String
     */
    function __toString() {
        return parent::__toString()." esta en la estanteria ".$this->estanteria." en la leja ".$this->leja;
    }
}
