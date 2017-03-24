<?php

/**
 * Clase ExceptionCaja, servirá para controlar los datos de una Caja, para que 
 * no sean ni negativos ni mayores de 150 ni iguales a 0.
 *
 * @author Alejandro
 */

class ExceptionCaja extends Exception{
    /**
     * Varible que contiene los datos que producen el error.
     *
     * @var type 
     */
    private $valor;
    /**
     * Constructor de la excepción. Pasaremos un mensaje y un código de error, más el valor
     * que produce el error.
     * 
     * @param type $message
     * @param type $code
     * @param type $_valor
     */
    public function __construct($message, $code, $_valor) {
        parent::__construct($message, $code, null);
        $this->valor=$_valor;
    }
    /**
     * Función para devolver la información de la excepción.
     * 
     * @return String
     */
    public function __toString() {
        if($this->code==0){
           return __CLASS__." en ".$this->message;
        }
        if($this->code==1){
           return __CLASS__." en ".$this->message." debido a que el valor es inferior a 0 : ".$this->valor;
        }
        if($this->code==2){
           return __CLASS__." en ".$this->message." debido a que el valor es igual a 0 : ".$this->valor;
        }
        if($this->code==3){
           return __CLASS__." en ".$this->message." debido a que el valor es superior a 150 :  ".$this->valor;
        }
    }
}
