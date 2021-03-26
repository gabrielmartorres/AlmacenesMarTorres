<?php

include_once "../DAO/DAOGestion.php";
include_once "../Modelo/CajaException.php";
include_once "../Modelo/Caja.php";
include_once "../Modelo/OcupacionEstanteria.php";

$Vcodigo = $_REQUEST['codigoCaja'];
session_start();
$ArrayObjCaja = $_SESSION['ArrayObjCaja'];
foreach ($ArrayObjCaja as $Object) {
    $codigo_ca = $Object->codigo_caja_back;
    $altura = $Object->altura_caja_back;
    $anchura = $Object->anchura_caja_back;
    $profundidad = $Object->profundidad_caja_back;
    $color = $Object->color_caja_back;
    $material = $Object->material_caja_back;
    $contenido = $Object->contenido_caja_back;
    $fecha_alta_caja = $Object->fecha_alta_caja_back;
    
    $Caja = new Caja($codigo_ca, $altura, $anchura, $profundidad, $color, $material, $contenido, $fecha_alta_caja);
}
$Eid_estanteria = $_REQUEST['estanteriasdisponibles'];
$Eleja_ocupada = $_REQUEST['lejasLibres'];
$Ocupacion = new OcupacionEstanteria($Eid_estanteria, $Eleja_ocupada);

$conexion->autocommit(false);
try {
    DAOGestion::devolverCaja($Caja, $Ocupacion);
    $conexion->commit();
    $conexion->autocommit(true);
    header("Location:../Vistas/_admin/VistaMensajes.php?Mensaje=La caja ha sido devuelta.");
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

