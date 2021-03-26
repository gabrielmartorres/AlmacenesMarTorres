<?php

include_once "../DAO/DAOGestion.php";
include_once "../Modelo/CajaException.php";
session_start();
try {
    $ArrayObjCaja = DAOGestion::listadoGeneralCajas();

    if (!empty($ArrayObjCaja)) {
        $_SESSION['ArrayObjCaja'] = $ArrayObjCaja;
        header("Location:../Vistas/_admin/VistaListadoGeneralCaja.php");
    }
} catch (CajaException $EE) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
    exit;
} catch (Exception $E) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
    exit;
}
?>

