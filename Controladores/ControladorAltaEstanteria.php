<?php

/* Recogemos los datos del formulario */
$Vcodigo = $_REQUEST['codigo'];
$Vmaterial = $_REQUEST['material'];
$VnumLejas = $_REQUEST['numLejas'];
$Vlejas_ocupadas = "0";
$Vfecha_alta = date('Y-m-d');
$Vpasillo = $_REQUEST['pasillosdisponibles'];
$Vnumero = $_REQUEST['numeroLibres'];

/* Hacer un objeto estanteria */
include_once "../Modelo/Estanteria.php";
$Estanteria = new Estanteria($Vcodigo, $Vmaterial, $VnumLejas, $Vlejas_ocupadas, $Vfecha_alta, $Vpasillo, $Vnumero);
//Este objeto lo pasamos al DAOGestion
include_once "../DAO/DAOGestion.php";
include_once "../Modelo/EstanteriaException.php";
$conexion->autocommit(false);
try {
    DAOGestion::insertarEstanteria($Estanteria);
    $conexion->commit();
    $conexion->autocommit(true);
    header("Location:../Vistas/_admin/VistaMensajes.php?Mensaje=Inserción Correcta");
    exit;
} catch (EstanteriaException $EE) {
    $conexion->rollback();
    $conexion -> autocommit(true);
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
    exit;
} catch (Exception $E) {
    $conexion->rollback();
    $conexion -> autocommit(true);
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
    exit;
}
?>
