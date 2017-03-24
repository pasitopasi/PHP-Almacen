<?php

/**
 * Objeto CajaSorpresa, servirá para guardar datos de una estanteria, todos los
 * posibles datos de dicha estanteria.
 *
 * @author Alejandro
 */

class Estanteria {
    /**
     * Variable que almacena el ID de la estanteria.
     * 
     * @var int 
     */
    private $ID;
    /**
     * Variable que almacena el código de la estanteria que tendrá en el sistema.
     * 
     * @var Stirng 
     */
    private $codigo;
    /**
     * Variable que almacena el tipo de material de que esta hecho la estanteria.
     *
     * @var String 
     */
    private $material;
    /**
     * Variable que almacena el númerode lejas que tiene la estanteria.
     * 
     * @var int 
     */
    private $n_lejas;
    /**
     * Variable que almacena el número de lejas ocupadas que tiene la estanteria.
     * 
     * @var int 
     */
    private $lejas_ocupadas;
    /**
     * Variable que almacena el pasillo en el que se encuentra la estanteria.
     * 
     * @var type 
     */
    private $pasillo;
    /**
     * Variable que almacena el número que tiene la caja en ese pasillo.
     *
     * @var int 
     */
    private $numero_p;
    /**
     * Constructor de la clase Estanteria.
     * 
     * @param String $_codigo
     * @param String $_material
     * @param int $_n_lejas
     * @param int $_lejas_o
     * @param String $_pasillo
     * @param int $_numero_p
     */
    public function __construct($_codigo, $_material, $_n_lejas, $_lejas_o, $_pasillo, $_numero_p){
        $this->codigo=$_codigo;
        $this->material=$_material;
        $this->n_lejas=$_n_lejas;
        $this->lejas_ocupadas=$_lejas_o;
        $this->pasillo=$_pasillo;
        $this->numero_p=$_numero_p;
    }
    /**
     * Función que devuelve el material de la estanteria.
     * 
     * @return String
     */
    public function getMaterial() {
        return $this->material;
    }
    /**
     * Función que pone el material del que esta hecho la estanteria.
     * 
     * @param String $_material
     */
    public function setMaterial($_material){
        $this->material=$_material;
    }
    /**
     * Función que devuelve el código de la estanteria.
     * 
     * @return String
     */
    public function getCodigo() {
        return $this->codigo;
    }
    /**
     * Función que pone el código de la estanteria.
     * 
     * @param String $_codigo
     */
    public function setCodigo($_codigo) {
        $this->codigo=$_codigo;
    }
    /**
     * Función que devuelve el número de lejas de la estanteria.
     * 
     * @return int
     */
    public function getNLejas() {
        return $this->n_lejas;
    }
    /**
     * Función que pone el número de lejas de la estanteria.
     * 
     * @param int $_nlejas
     */
    public function setNLejas($_nlejas) {
        $this->n_lejas=$_nlejas;
    }
    /**
     * Función que devuelve el número de lejas ocupadas de la estanteria.
     * 
     * @return int
     */
    public function getOLejas() {
        return $this->lejas_ocupadas;
    }
    /**
     * Función que pone el número de lejas ocupadas de la estanteria.
     * 
     * @param int $_olejas
     */
    public function setOLejas($_olejas) {
        $this->lejas_ocupadas=$_olejas;
    }
    /**
     * Función que devuelve el pasillo donde se encunetrá la estanteria.
     * 
     * @return String
     */
    public function getPasillo() {
        return $this->pasillo;
    }
    /**
     * Función que pone el pasillo donde se encunetrá la estanteria.
     * 
     * @param String $_pasillo
     */
    public function setPasillo($_pasillo) {
         $this->pasillo=$_pasillo;
    }
    /**
     * Función que devuelve el número donde se encuentra la estanteria.
     * 
     * @return int
     */
    public function getNumeroP() {
        return $this->numero_p;
    }
    /**
     * Función que pone el número donde se encuentra la estanteria.
     * 
     * @param int $_numerop
     */
    public function setNumeroP($_numerop) {
        $this->numero_p=$_numerop;
    }
    /**
     * Función que devuelve el ID de la estanteria.
     * 
     * @param int $_ID
     */
    public function setID($_ID) {
        $this->ID=$_ID;
    }
    /**
     * Función que devuelve el ID de la estanteria.
     * 
     * @return int
     */
    public function getID() {
        return $this->ID;
    }
    /**
     * Función para devolver la información de la estanteria.
     * 
     * @return String
     */
    public function __toString() {
        return $this->codigo." esta hecha de ".$this->material." tiene ".$this->n_lejas
        ." con ".$this->lejas_ocupadas." lejas ocupadas, situada en el pasillo ".$this->pasillo
        ." número ".$this->numero_p;
    }
}
