<?php
/**
 * Description of Estanteria
 *
 * @author Gabriel
 */
class Estanteria {
    private $id_es;
    private $codigo_es;
    private $material_estanteria;
    private $numLejas;
    private $lejas_ocupadas;
    private $fecha_alta_estanteria;
    private $pasillo;
    private $numero;
    
    function __construct($codigo_es, $material_estanteria, $numLejas, $lejas_ocupadas, $fecha_alta_estanteria, $pasillo, $numero) {
        $this->setCodigo_es($codigo_es);
        $this->setMaterial_estanteria($material_estanteria);
        $this->setNumLejas($numLejas);
        $this->setLejas_ocupadas($lejas_ocupadas);
        $this->setFecha_alta_estanteria($fecha_alta_estanteria);
        $this->setPasillo($pasillo);
        $this->setNumero($numero);
    }
    
    
    function getId_es() {
        return $this->id_es;
    }

    function getCodigo_es() {
        return $this->codigo_es;
    }

    function getMaterial_estanteria() {
        return $this->material_estanteria;
    }

    function getNumLejas() {
        return $this->numLejas;
    }
    
    function getLejas_ocupadas() {
        return $this->lejas_ocupadas;
    }

    function get_estanteria() {
        return $this->fecha_alta_estanteria;
    }
    
    function getFecha_alta_estanteria() {
        return $this->fecha_alta_estanteria;
    }
    
    function getPasillo() {
        return $this->pasillo;
    }

    function getNumero() {
        return $this->numero;
    }

    function setId_es($id_es) {
        $this->id_es = $id_es;
    }
    
    function setCodigo_es($codigo_es) {
        $this->codigo_es = $codigo_es;
    }

    function setMaterial_estanteria($material_estanteria) {
        $this->material_estanteria = $material_estanteria;
    }

    function setNumLejas($numLejas) {
        $this->numLejas = $numLejas;
    }

    function setLejas_ocupadas($lejas_ocupadas) {
        $this->lejas_ocupadas = $lejas_ocupadas;
    }

    function setFecha_alta_estanteria($fecha_alta_estanteria) {
        $this->fecha_alta_estanteria = $fecha_alta_estanteria;
    }

    function setPasillo($pasillo) {
        $this->pasillo = $pasillo;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    public function __toString() {
        return "Id: " .$this->id_es .
               "Codigo: " .$this->codigo_es .
               "Material: " .$this->material_estanteria .
               "Número de lejas: " .$this->numLejas.
               "Lejas ocupadas: " .$this->lejas_ocupadas.
               "Fecha de alta: " .$this->fecha_alta_estanteria.
               "Pasillo: " .$this->pasillo.
               "Número: " .$this->numero;
    }

}
