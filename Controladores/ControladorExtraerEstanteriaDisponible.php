<?php

include '../DAO/DAOGestion.php';

session_start();

try {
    $ArrayObjEstanteria = DAOGestion::extraerEstanteriasDisponibles();
    if (!empty($ArrayObjEstanteria)) {
        $_SESSION['ArrayObjEstanteria'] = $ArrayObjEstanteria;
            header("Location:../Vistas/_admin/VistaAltaCaja.php");
    }
} catch (EstanteriaException $EE) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
    exit;
} catch (Exception $E) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
    exit;
}
?>

