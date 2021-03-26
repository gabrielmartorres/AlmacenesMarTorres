<?php
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

session_start();
include_once "../Modelo/UsuarioException.php";
include_once "../DAO/DAOGestion.php";
try {
    DAOGestion::IniciarSesion($email, $password);
    header("Location:../Vistas/_admin/index.php");
} catch (UsuarioException $EE) {
    header("Location:../Vistas/_admin/VistaInicioSesion.php");
}
?>
