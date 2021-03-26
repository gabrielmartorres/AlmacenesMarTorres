<?php

include '../DAO/DAOGestion.php';
try {
    $ExisteUsuario = DAOGestion::ComprobarUsuario();
    if ($ExisteUsuario) {
        header("Location:../Vistas/_admin/VistaInicioSesion.php");
    } else {
        header("Location:../Vistas/_admin/VistaRegistroUsuario.php");
    }
} catch (UsuarioException $EE) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$EE");
} catch (Exception $E) {
    header("Location:../Vistas/_admin/VistaErrores.php?Error=$E");
    exit;
}
?>