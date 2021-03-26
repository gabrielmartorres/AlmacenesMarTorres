<?php
// Códigio para cargar el ajax de mostrar cajas para la salida de mercancía.
// Utilizaremos conexion PDO PHP
function conexion() {
	//Declaramos el servidor, la BD, el usuario Mysql y Contraseña BD.
    return new PDO('mysql:host=localhost;dbname=bd_almacen', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = conexion();
$keyword = '%'.$_POST['palabra'].'%';
$sql = "SELECT * FROM caja_backup WHERE codigo_caja_back LIKE (:keyword) ORDER BY id_caja_back ASC LIMIT 0, 4";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
	// Colocaremos negrita a los textos
	$pais_nombre = str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $milista['codigo_caja_back']);
	// Aquí, agregaremos opciones
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $milista['codigo_caja_back']).'\')">'.$pais_nombre.'</li>';
}
?>