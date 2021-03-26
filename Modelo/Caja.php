<?php

/**
 * Description of Caja
 *
 * @author Gabriel
 */
class Caja {
    private $id_ca;
    private $codigo_ca;
    private $altura;
    private $anchura;
    private $profundidad;
    private $color;
    private $material_caja;
    private $contenido;
    private $fecha_alta_caja;
    
    function __construct($codigo_ca, $altura, $anchura, $profundidad, $color, $material_caja, $contenido, $fecha_alta_caja) {
        $this->setCodigo_ca($codigo_ca);
        $this->setAltura($altura);
        $this->setAnchura($anchura);
        $this->setProfundidad($profundidad);
        $this->setColor($color);
        $this->setMaterialCaja($material_caja);
        $this->setContenido($contenido);
        $this->setFecha_alta_caja($fecha_alta_caja);        
    }
    
    function getId_ca() {
        return $this->id_ca;
    }

    function getCodigo_ca() {
        return $this->codigo_ca;
    }

    function getAltura() {
        return $this->altura;
    }

    function getAnchura() {
        return $this->anchura;
    }

    function getProfundidad() {
        return $this->profundidad;
    }

    function getColor() {
        return $this->color;
    }

    function getMaterialCaja() {
        return $this->material_caja;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getFecha_alta_caja() {
        return $this->fecha_alta_caja;
    }

    function setId_ca($id_ca) {
        $this->id_ca = $id_ca;
    }

    function setCodigo_ca($codigo_ca) {
        $this->codigo_ca = $codigo_ca;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setAnchura($anchura) {
        $this->anchura = $anchura;
    }

    function setProfundidad($profundidad) {
        $this->profundidad = $profundidad;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setMaterialCaja($material_caja) {
        $this->material_caja = $material_caja;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setFecha_alta_caja($fecha_alta_caja) {
        $this->fecha_alta_caja = $fecha_alta_caja;
    }

    public function __toString() {
        return "Id: " .$this->id_ca.
               "Codigo: " .$this->codigo_ca.
               "Altura: " .$this->altura.
               "Anchera: " .$this->anchura.
               "Profundidad: " .$this->profundidad.
               "Color: " .$this->color.
               "Material: " .$this->material_caja.
               "Contenido: " .$this->contenido.
               "Fecha de alta: " .$this->fecha_alta_caja;
    }

      
    
}
