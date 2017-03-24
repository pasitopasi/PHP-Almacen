<?php

/**
 * Objeto Usuario, servirá para crear un usuario.
 *
 * @author Alejandro
 */

class Usuario {
    /**
     * Variable que almacena el nombre del usuario.
     *
     * @var String 
     */
    private $nombre;
    /**
     * Variable que almacena los apellidos del usuario.
     *
     * @var String 
     */
    private $apellido;
    /**
     * Variable que almacena el nick del usuario.
     * 
     * @var String 
     */
    private $usuario;
    /**
     * Variable que almacena la contraseña del usuario.
     *
     * @var String 
     */
    private $contrasena;
    /**
     * Constructor de la clase Usuario.
     * 
     * @param String $_nombre
     * @param String $_apellido
     * @param String $_usuario
     * @param String $_contrasena
     */
    public function __construct($_nombre, $_apellido, $_usuario, $_contrasena){
        $this->nombre=$_nombre;
        $this->apellido=$_apellido;
        $this->usuario=$_usuario;
        $this->setContrasena($_contrasena);
    }
    /**
     * Función que devuelve el nombre del usuario.
     * 
     * @return String
     */
    public function getNombre() {
        return $this->nombre;
    }
    /**
     * Función que devuelve los apellidos del usuario.
     * 
     * @return String
     */
    public function getApellido() {
        return $this->apellido;
    }
    /**
     * Función que devuelve el nick del usuario.
     * 
     * @return String
     */
    public function getUsuario() {
        return $this->usuario;
    }
    /**
     * Función que devuelve la contraseña del usuario.
     * 
     * @return String
     */
    public function getContrasena() {
        return $this->contrasena;
    }
    /**
     * Función para poner el nombre del usuario.
     * 
     * @param type $_nombre
     */
    public function setNombre($_nombre) {
        $this->nombre=$_nombre;
    }
    /**
     * Función para poner los apellidos del usuario.
     * 
     * @param type $_apellido
     */
    public function setApellido($_apellido) {
        $this->apellido=$_apellido;
    }
    /**
     * Función para poner el nick del usuario.
     * 
     * @param type $_usuario
     */
    public function setUsuario($_usuario){
        $this->usuario=$_usuario;
    }
    /**
     * Función para poner la contraseña del usuario.
     * 
     * @param type $_contrasena
     */
    public function setContrasena($_contrasena){
        $salt = '$bgr$/';
        $password = md5($salt . sha1($_contrasena));
        $this->contrasena=$password;
    }
    /**
     * Función para devolver la información del usuario.
     * 
     * @return String
     */
    public function __toString() {
        return "Usuario: ".$this->getUsuario().", con nombre y apellido: ".$this->getNombre()." ".$this->getApellido()." tiene de contraseña: ".$this->getContrasena();
    }
    
}
