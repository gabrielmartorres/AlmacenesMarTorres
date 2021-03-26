<?php

/* Recogemos los datos del formulario */
$Vcodigo = $_REQUEST['codigo'];
$Valtura = $_REQUEST['altura'];
$Vanchura = $_REQUEST['anchura'];
$Vprofundidad = $_REQUEST['profundidad'];
$Vcolor = $_REQUEST['color'];
$Vmaterial = $_REQUEST['material'];
$Vcontenido = $_REQUEST['contenido'];
$Vfecha_alta = date('Y-m-d');

$Eid_estanteria = $_REQUEST['estanteriasdisponibles'];
$Eleja_ocupada = $_REQUEST['lejasLibres'];

/* Hacer un objeto caja */
include_once "../Modelo/Caja.php";
$Caja = new Caja($Vcodigo, $Valtura, $Vanchura, $Vprofundidad, $Vcolor, $Vmaterial, $Vcontenido, $Vfecha_alta);
include_once "../Modelo/OcupacionEstanteria.php";
$Ocupacion = new OcupacionEstanteria($Eid_estanteria, $Eleja_ocupada);
//Este objeto lo pasamos al DAOGestion
include_once "../DAO/DAOGestion.php";
include_once "../Modelo/CajaException.php";
$conexion->autocommit(false);
try {
    DAOGestion::insertarCaja($Caja, $Ocupacion);  
    $conexion->commit();
    $conexion->autocommit(true);
    header("Location:../Vistas/_admin/VistaMensajes.php?Mensaje=Inserción Correcta");
    exit;
} catch (CajaException $EE) {
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
