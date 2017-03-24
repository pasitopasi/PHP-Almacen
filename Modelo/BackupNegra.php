<?php
include_once 'CajaNegra.php';

/**
 * Objeto BackupNegra, servirá para guardar datos de una Caja Negra, todos los
 * posibles datos de dicha caja, tanto su objeto como su ocupación.
 *
 * @author Alejandro
 */

class BackupNegra extends CajaNegra{
    /**
     * Variable que servirá para almacenar el objeto Caja Negra.
     *
     * @var CajaNegra 
     */
    private $negra;
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
     * Constructor de la clase BackupNegra.
     * 
     * @param CajaNegra $_caja
     * @param int $_codigoEstanteria
     * @param int $_leja
     */
    function __construct($_caja, $_codigoEstanteria, $_leja) {
        if($_caja instanceof CajaNegra){
            parent::__construct($_caja->getCodigo(), $_caja->getAnchura(),$_caja->getAltura(), $_caja->getProfundidad(), $_caja->getColor(),$_caja->getPlaca_base());
            $this->negra=$_caja;
            $this->estanteria=$_codigoEstanteria;
            $this->leja=$_leja;
        }
    }
    /**
     * Para poner la Caja Negra.
     * 
     * @param CajaNegra $_caja
     */
    function setNegra($_caja){
        $this->negra=$_caja;
    }
    /**
     * Para poner el ID de la estanteria donde se encuentre la Caja Negra.
     * 
     * @param int $_codigoEstanteria
     */
    function setEstanteria($_codigoEstanteria){
        $this->estanteria=$_codigoEstanteria;
    }
    /**
     * Para poner la leja donde este la Caja Negra.
     * 
     * @param int $_leja
     */
    function setLeja($_leja){
        $this->leja=$_leja;
    }
    /**
     * Nos devuelve el objeto Caja Negra del que tenemos el backup.
     * 
     * @return CajaNegra
     */
    function getNegra(){
        return $this->negra;
    }
    /**
     * Nos devuelve el ID de la estanteria donde se encontraba la Caja Negra.
     * 
     * @return int
     */
    function getEstanteria(){
        return $this->estanteria;
    }
    /**
     * Nos devuelve la leja donde estaba la Caja Negra.
     * 
     * @return int
     */
    function getLeja(){
        return $this->leja;
    }
    /**
     * Pequeño String que nos informa de la Caja Negra.
     * 
     * @return String
     */
    function __toString() {
        return parent::__toString()." esta en la estanteria ".$this->estanteria." en la leja ".$this->leja;
    }
    
}
