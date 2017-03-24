<?php
include_once 'CajaSorpresa.php';

/**
 * Objeto BackupNegra, servirá para guardar datos de una Caja Negra, todos los
 * posibles datos de dicha caja, tanto su objeto como su ocupación.
 *
 * @author Alejandro
 */

class BackupSorpresa extends CajaSorpresa{
    /**
     * Variable que servirá para almacenar el objeto Caja Sorpresa.
     *
     * @var CajaSorpresa 
     */
    private $sorpresa;
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
     * Constructor de la clase BackupSorpresa.
     * 
     * @param CajaSorpresa $_caja
     * @param int $_codigoEstanteria
     * @param int $_leja
     */
    function __construct($_caja, $_codigoEstanteria, $_leja) {
        if($_caja instanceof CajaSorpresa){
            parent::__construct($_caja->getCodigo(), $_caja->getAnchura(),$_caja->getAltura(), $_caja->getProfundidad(), $_caja->getColor(), $_caja->getContenido(), $_caja->getDevolucion());
            $this->sorpresa=$_caja;
            $this->estanteria=$_codigoEstanteria;
            $this->leja=$_leja;
        }
    }
    /**
     * Para poner la Caja Sorpresa.
     * 
     * @param CajaSorpresa $_caja
     */
    function setSorpresa($_caja){
        $this->sorpresa=$_caja;
    }
    /**
     * Para poner el ID de la estanteria donde se encuentre la Caja Sorpresa.
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
     * Nos devuelve el objeto Caja Sorpresa del que tenemos el backup.
     * 
     * @return CajaSorpresa
     */
    function getSorpresa(){
        return $this->sorpresa;
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
     * Pequeño String que nos informa de la Caja Sorpresa.
     * 
     * @return String
     */
    function __toString() {
        return parent::__toString()." esta en la estanteria ".$this->estanteria." en la leja ".$this->leja;
    }
}
