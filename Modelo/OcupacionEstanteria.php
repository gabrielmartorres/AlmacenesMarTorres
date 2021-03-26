<?php

/**
 * Description of OcupacionEstanteria
 *
 * @author addaw19
 */
class OcupacionEstanteria {
    //put your code here
    private $id;
    private $id_estanteria;
    private $leja_ocupada;
    private $id_caja;
    
    function __construct($id_estanteria, $leja_ocupada) {
        $this->setId_estanteria($id_estanteria);
        $this->setLeja_ocupada($leja_ocupada);
    }

    function getId() {
        return $this->id;
    }

    function getId_estanteria() {
        return $this->id_estanteria;
    }

    function getLeja_ocupada() {
        return $this->leja_ocupada;
    }

    function getId_caja() {
        return $this->id_caja;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_estanteria($id_estanteria) {
        $this->id_estanteria = $id_estanteria;
    }

    function setLeja_ocupada($leja_ocupada) {
        $this->leja_ocupada = $leja_ocupada;
    }

    function setId_caja($id_caja) {
        $this->id_caja = $id_caja;
    }

    public function __toString() {
        return "Id: " .$this->id .
               "Id de estanteria: " .$this->id_estanteria .
               "Leja ocupada: " .$this->leja_ocupada .
               "Id de caja: " .$this->id_caja;
    }

}
