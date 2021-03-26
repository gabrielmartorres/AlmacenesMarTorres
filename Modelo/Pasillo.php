<?php
/**
 * Description of Pasillo
 *
 * @author addaw19
 */
class Pasillo {
    private $id_pasillo;
    private $letra_pasillo;
    private $huecos_pasillos;
    
    function __construct($id_pasillo, $letra_pasillo, $huecos_pasillos) {
        $this->setId_pasillo($id_pasillo);
        $this->setLetra_pasillo($letra_pasillo);
        $this->setHuecos_pasillos($huecos_pasillos);
    }
    
    function getId_pasillo() {
        return $this->id_pasillo;
    }

    function getLetra_pasillo() {
        return $this->letra_pasillo;
    }

    function getHuecos_pasillos() {
        return $this->huecos_pasillos;
    }

    function setId_pasillo($id_pasillo) {
        $this->id_pasillo = $id_pasillo;
    }

    function setLetra_pasillo($letra_pasillo) {
        $this->letra_pasillo = $letra_pasillo;
    }

    function setHuecos_pasillos($huecos_pasillos) {
        $this->huecos_pasillos = $huecos_pasillos;
    }

    public function __toString() {
        return "Id del pasillo: " .$this->id_pasillo.
               "Letra del pasillo: " .$this->letra_pasillo.
               "Huecos de los pasillos: " .$this->huecos_pasillos;
    }

}
