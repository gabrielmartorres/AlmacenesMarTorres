<?php

include_once "../DAO/DAOGestion.php";
include_once "../Modelo/CajaException.php";
session_start();
$Vcodigo = $_REQUEST['codigoCaja'];
$opcion = $_SESSION['opciones'];

if ($opcion == "devolucion") {
    try {
        $ArrayObjCaja = DAOGestion::obtenerCajaBackup($Vcodigo);
        $ArrayObjEstanteria = DAOGestion::extraerEstanteriasDisponibles();
        
        if (!empty($ArrayObjCaja) && !empty($ArrayObjEstanteria) ) {
            $_SESSION['ArrayObjCaja'] = $ArrayObjCaja;
            $_SESSION['ArrayObjEstanteria'] = $ArrayObjEstanteria;
            header("Location:../Vistas/_admin/VistaDatosCajaDevolucion.php?opcion=devolucion");
        }
    } catch (CajaException $EE) {
        header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
        exit;
    } catch (Exception $E) {
        header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
        exit;
    }
} elseif ($opcion == "salida") {
    try {
        $ArrayObjCaja = DAOGestion::obtenerCaja($Vcodigo);

        if (!empty($ArrayObjCaja)) {
            $_SESSION['ArrayObjCaja'] = $ArrayObjCaja;
            header("Location:../Vistas/_admin/VistaDatosCaja.php");
        }
    } catch (CajaException $EE) {
        header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
        exit;
    } catch (Exception $E) {
        header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
        exit;
    }
}
?>

