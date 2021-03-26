<?php

include_once "../DAO/DAOGestion.php";
include_once "../Modelo/CajaException.php";
include_once "../Modelo/EstanteriaException.php";
include_once "../Modelo/AlmacenException.php";
session_start();
try {
    $ArrayObjInventario = DAOGestion::listadoInventario();

    $_SESSION['ArrayObjInventario'] = $ArrayObjInventario;
    header("Location:../Vistas/_admin/VistaInventario.php");
} catch (CajaException $EE) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
    exit;
} catch (EstanteriaExceptionException $EE) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
    exit;
} catch (Exception $E) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
    exit;
}
?>

