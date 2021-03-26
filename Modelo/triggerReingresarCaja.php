<?php
$borrar="DROP trigger if exists trigger_reingresar";

$resultado2=$conexion->query($borrar)or die('el drop trigger ha fallado');

$buscarIdCaja = "SELECT ID_CA FROM caja ORDER BY ID_CA DESC LIMIT 1";  //Obtengo el ultimo registro
        $resultadoId = $conexion->query($buscarIdCaja); //Contiene el array asociativo del buffer
        if ($resultadoId->num_rows == 1) {
            $fila = $resultadoId->fetch_assoc();  //Extraigo la fila del array asociativo
            $idCaja = $fila['ID_CA'];
            $idCaja = $idCaja + 1;
        } else {
            $idCaja = 1;
        }

//$idCaja = $conexion->last_insert_id;
$codigo_ca=$CajaRetornar->getCodigo_ca();
$altura=$CajaRetornar->getAltura();
$anchura=$CajaRetornar->getAnchura();
$profundidad=$CajaRetornar->getProfundidad();
$color=$CajaRetornar->getColor();
$material_caja=$CajaRetornar->getMaterialCaja();
$contenido=$CajaRetornar->getContenido();
$fecha_alta_caja=$CajaRetornar->getFecha_alta_caja();
        
$IdEstanteria= $Estanteria->getId_estanteria();
$leja= $Estanteria->getLeja_ocupada();

$trigger='CREATE TRIGGER TRIGGER_REINGRESAR
    AFTER DELETE
    ON caja_backup FOR EACH ROW
BEGIN
    INSERT INTO caja (ID_CA,CODIGO_CA,ALTURA,ANCHURA,PROFUNDIDAD,COLOR,MATERIAL_CAJA,CONTENIDO,FECHA_ALTA_CAJA)
        VALUES ("'.$idCaja.'", "'.$codigo_ca.'", "'.$altura.'", "'.$anchura.'", "'.$profundidad.'", "'.$color.'", "'.$material_caja.'", "'.$contenido.'", "'.$fecha_alta_caja.'");
    INSERT INTO ocupacion_estanteria (id_ocu,id_estanteria,leja_ocupada,id_caja) VALUES (null,"'.$IdEstanteria.'","'.$leja.'","'.$idCaja.'");
    UPDATE estanteria SET lejas_ocupadas = lejas_ocupadas +1 WHERE id_es="'.$IdEstanteria.'";
END';
var_dump($trigger);die();
$resultado3=$conexion->query($trigger) or die('el CREATE trigger ha fallado');

?>
