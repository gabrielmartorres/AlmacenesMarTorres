<?php

include "conexion.php";
include_once "../Modelo/Estanteria.php";
include_once "../Modelo/Caja.php";
include_once '../Modelo/EstanteriaException.php';
include_once '../Modelo/AlmacenException.php';
include_once '../Modelo/CajaException.php';
include_once '../Modelo/UsuarioException.php';


class DAOGestion {

    public function insertarEstanteria($OEstanteria) {
        /* Busco el último id de estanteria registrado y le sumo 1 posición para el nuevo. Si no hay registros le pongo el número 1 */
        global $conexion;
        $buscarIdEst = "SELECT id_es FROM estanteria ORDER BY id_es DESC LIMIT 1";  //Obtengo el ultimo registro
        $resultadoId = $conexion->query($buscarIdEst); //Contiene el array asociativo del buffer
        if ($resultadoId->num_rows == 1) {
            $fila = $resultadoId->fetch_assoc();  //Extraigo la fila del array asociativo
            $idEstanteria = $fila['id_es'];
            $idEstanteria = $idEstanteria + 1;
        } else {
            $idEstanteria = 1;
        }

        /* Todo ha ido bien. Ha encontrado el id */
        $codigo_es = $OEstanteria->getCodigo_es();
        $material_estanteria = $OEstanteria->getMaterial_estanteria();
        $numLejas = $OEstanteria->getNumLejas();
        $lejas_ocupadas = $OEstanteria->getLejas_ocupadas();
        $fecha_alta_estanteria = $OEstanteria->getFecha_alta_estanteria();
        $pasillo = $OEstanteria->getPasillo();
        $numero = $OEstanteria->getNumero();

        if (!$idEstanteria || !$codigo_es || !$material_estanteria || !$numLejas || !$pasillo || !$numero) {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Introduce todos los datos de la estantería. Inserción fallida';
            throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
        }

        $OrdenSQL = $conexion->prepare("INSERT INTO ESTANTERIA VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $OrdenSQL->bind_param('isssssss', $idEstanteria, $codigo_es, $material_estanteria, $numLejas, $lejas_ocupadas, $fecha_alta_estanteria, $pasillo, $numero);
        $OrdenSQL->execute();

        $FilasAfectadas = $OrdenSQL->affected_rows;
        if ($FilasAfectadas == 1) {
            $OrdenSQL3 = "UPDATE pasillo SET huecos_pasillos = huecos_pasillos +1 WHERE id_pasillo='$pasillo'";
            $FilasAfectadas2 = $conexion->query($OrdenSQL3);

            if ($FilasAfectadas2 == 1) {
                return;
            } else {
                $Mensaje = $conexion->error;
                $Codigo = $conexion->errno;
                $Lugar = 'Probablemente algo haya salido mal. Actualización de pasillo fallida';
                throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
            }
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Probablemente algo haya salido mal. Inserción fallida';
            throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function listadoGeneralEstanterias() {
        global $conexion;
        $ArrayObjectsEstanteria = array();
        $ordenSQL = "SELECT * FROM ESTANTERIA E, PASILLO P WHERE E.pasillo=P.id_pasillo ORDER BY P.letra_pasillo, E.numero";

        $resultado = $conexion->query($ordenSQL);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_object();

            while ($fila) {

                $ArrayObjectsEstanteria[] = $fila;
                $fila = $resultado->fetch_object();
            }
        }
        if (!empty($ArrayObjectsEstanteria)) {
            return $ArrayObjectsEstanteria;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'No hay registros de estanterías';
            throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function insertarCaja($OCaja, $OOcupacion) { 
        /* Busco el último id de caja registrado y le sumo 1 posición para el nuevo. Si no hay registros le pongo el número 1 */
        global $conexion;

        $buscarIdCaja = "SELECT ID_CA FROM caja ORDER BY ID_CA DESC LIMIT 1";  
        $resultadoId = $conexion->query($buscarIdCaja); 
        if ($resultadoId->num_rows == 1) {
            $fila = $resultadoId->fetch_assoc();  
            $idCaja = $fila['ID_CA'];
            $idCaja = $idCaja + 1;
        } else {
            $idCaja = 1;
        }

        /* Todo ha ido bien. Ha encontrado el id */
        $codigo_ca = $OCaja->getCodigo_ca();
        $altura = $OCaja->getAltura();
        $anchura = $OCaja->getAnchura();
        $profundidad = $OCaja->getProfundidad();
        $color = $OCaja->getColor();
        $material_caja = $OCaja->getMaterialCaja();
        $contenido = $OCaja->getContenido();
        $fecha_alta_caja = $OCaja->getFecha_alta_caja();


        if (!$idCaja || !$codigo_ca || !$altura || !$anchura || !$profundidad || !$color || !$material_caja || !$contenido || !$fecha_alta_caja) {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Introduce todos los datos de caja. Inserción fallida';
            throw new CajaException($Mensaje, $Codigo, $Lugar);
        }

        $OrdenSQL = $conexion->prepare("INSERT INTO CAJA VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $OrdenSQL->bind_param('issssssss', $idCaja, $codigo_ca, $altura, $anchura, $profundidad, $color, $material_caja, $contenido, $fecha_alta_caja);
        $OrdenSQL->execute();
        
        $FilasAfectadas = $OrdenSQL->affected_rows;

        if ($FilasAfectadas == 1) {

            //Inserto en la tabla ocupacion_estanteria
            $Eid_estanteria = (int) $OOcupacion->getId_estanteria();
            $Eleja_ocupada = (int) $OOcupacion->getLeja_ocupada();
            $EidCaja = $idCaja;

            $buscarIdOcupacion = "SELECT id_ocu FROM ocupacion_estanteria ORDER BY id_ocu DESC LIMIT 1";  //Obtengo el ultimo registro
            $resultadoIdOcupacion = $conexion->query($buscarIdOcupacion); //Contiene el array asociativo del buffer
            if ($resultadoIdOcupacion->num_rows == 1) {
                $fila = $resultadoIdOcupacion->fetch_assoc();  //Extraigo la fila del array asociativo
                $EidOcupacion = $fila['id_ocu'];
                $EidOcupacion = $EidOcupacion + 1;
            } else {
                $EidOcupacion = 1;
            }

            $OrdenSQL2 = $conexion->prepare("INSERT INTO ocupacion_estanteria VALUES(?, ?, ?, ?)");
            $OrdenSQL2->bind_param('iiii', $EidOcupacion, $Eid_estanteria, $Eleja_ocupada, $EidCaja);
            $OrdenSQL2->execute();

            $FilasAfectadas = $OrdenSQL2->affected_rows;
            if ($FilasAfectadas == 1) {
                $OrdenSQL3 = "UPDATE estanteria SET lejas_ocupadas = lejas_ocupadas +1 WHERE id_es='$Eid_estanteria'";
                $FilasAfectadas2 = $conexion->query($OrdenSQL3);

                if ($FilasAfectadas2 == 1) {
                    return;
                } else {
                    $Mensaje = $conexion->error;
                    $Codigo = $conexion->errno;
                    $Lugar = 'Probablemente algo haya salido mal. Actualización de estanteria fallida';
                    throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
                }
            } else {
                $Mensaje = $conexion->error;
                $Codigo = $conexion->errno;
                $Lugar = 'Probablemente algo haya salido mal. Inserción de ocupacion de estanteria fallida';
                throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
            }
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Probablemente algo haya salido mal. Inserción de caja fallida';
            throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
        }
    }
    
    public function extraerEstanteriasDisponibles() {
        global $conexion;
        $ArrayObjEstanteria = array();

        $ordenSQL = "SELECT * FROM estanteria WHERE lejas_ocupadas < numLejas";

        $resultado = $conexion->query($ordenSQL);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();

            while ($fila) {
                $id_es = $fila['id_es'];
                $codigo_es = $fila['codigo_es'];
                $material_estanteria = $fila['material_estanteria'];
                $numLejas = $fila['numLejas'];
                $lejas_ocupadas = $fila['lejas_ocupadas'];
                $fecha_alta_estanteria = $fila['fecha_alta_estanteria'];
                $pasillo = $fila['pasillo'];
                $numero = $fila['numero'];

                if ($lejas_ocupadas != $numLejas) {
                    $Estanteria = new Estanteria($codigo_es, $material_estanteria, $numLejas, $lejas_ocupadas, $fecha_alta_estanteria, $pasillo, $numero);
                    $Estanteria->setId_es($id_es);
                    $ArrayObjEstanteria[] = $Estanteria;
                }
                $fila = $resultado->fetch_assoc();
            }
        }
        if (!empty($ArrayObjEstanteria)) {
            return $ArrayObjEstanteria;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'No hay registros de estanterías';
            throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function extraerPasillosDisponibles() {
        global $conexion;
        $ArrayObjEstanteria = array();

        $ordenSQL = "SELECT id_pasillo, letra_pasillo FROM pasillo P, almacen A WHERE P.huecos_pasillos < A.NUMERO_HUECOS_PASILLO";

        $resultado = $conexion->query($ordenSQL);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_object();

            while ($fila) {

                $ArrayObjEstanteria[] = $fila;
                $fila = $resultado->fetch_object();
            }
        }
        if (!empty($ArrayObjEstanteria)) {
            return $ArrayObjEstanteria;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'No hay pasillos disponibles, el almacén está lleno.';
            throw new EstanteriaException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function lejasDisponibles($IdEstanteria) {
        global $conexion;
        //Obtengo el número total de lejas de la estantería
        $sql = $conexion->prepare("SELECT numLejas FROM estanteria WHERE ID_ES= ?");
        $sql->bind_param('s', $IdEstanteria);
        $sql->execute();
        $resultadoLejas = $sql->get_result();

        if ($resultadoLejas->num_rows == 1) {
            $fila = $resultadoLejas->fetch_assoc();  
            $NumeroLejasTotal = $fila['numLejas']; 
        }

        //Buscar las lejas ocupadas
        $ArrayLejasOcupadas = array(); //Aquí guardo el número de lejas ocupadas.

        $sql2 = $conexion->prepare("SELECT leja_ocupada FROM ocupacion_estanteria WHERE id_estanteria= ?");
        $sql2->bind_param('s', $IdEstanteria);
        $sql2->execute();
        $resultadoLejasOcupadas = $sql2->get_result();
        
        if ($resultadoLejasOcupadas->num_rows > 0) {
            $Obj = $resultadoLejasOcupadas->fetch_array()['leja_ocupada'];

            while ($Obj) {
                $ArrayLejasOcupadas[] = $Obj; //al poner el array[] se va rellenando al siguiente
                $Obj = $resultadoLejasOcupadas->fetch_array()['leja_ocupada'];
            }
        }

        //Array de lejas disponibles
        $arrayDisponibles = array();

        for ($i = 1; $i <= $NumeroLejasTotal; $i++) {
            if (!in_array($i, $ArrayLejasOcupadas)) {
                $arrayDisponibles[] = $i;
            }
        }

        return $arrayDisponibles;
    }

    public function listadoGeneralCajas() {
        global $conexion;
        $ArrayObjectsCaja = array();
        $ordenSQL = "SELECT * FROM caja";

        $resultado = $conexion->query($ordenSQL);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc(); 
            while ($fila) {
                $codigo_ca = $fila['CODIGO_CA'];
                $altura = $fila['ALTURA'];
                $anchura = $fila['ANCHURA'];
                $profundidad = $fila['PROFUNDIDAD'];
                $color = $fila['COLOR'];
                $material_caja = $fila['MATERIAL_CAJA'];
                $contenido = $fila['CONTENIDO'];
                $fecha_alta_caja = $fila['FECHA_ALTA_CAJA'];

                $Caja = new Caja($codigo_ca, $altura, $anchura, $profundidad, $color, $material_caja, $contenido, $fecha_alta_caja);
                $ArrayObjectsCaja[] = $Caja;
                $fila = $resultado->fetch_assoc();
            }
        }
        if (!empty($ArrayObjectsCaja)) {
            return $ArrayObjectsCaja;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'No hay registros de cajas';
            throw new CajaException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function listadoInventario() {
        global $conexion;
        $ArrayObjects = array();
        $ordenSQL = "SELECT * FROM estanteria E
LEFT JOIN ocupacion_estanteria O ON O.id_estanteria = E.id_es
LEFT JOIN caja C ON O.id_caja = C.ID_CA
LEFT JOIN pasillo P ON P.id_pasillo = E.pasillo 
ORDER BY E.pasillo, E.numero, O.leja_ocupada";

        $resultado = $conexion->query($ordenSQL);
        if ($resultado->num_rows > 0) {
            $Obj = $resultado->fetch_object(); 

            while ($Obj) {
                $ArrayObjects[] = $Obj; 
                $Obj = $resultado->fetch_object();
            }
        }
        if (!empty($ArrayObjects)) {
            return $ArrayObjects;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'El almacén está vacío.';
            throw new AlmacenException($Mensaje, $Codigo, $Lugar);
        }
        
    }

    public function numerosDisponibles($IdPasillo) {
        global $conexion;
        //Obtengo el número de huecos por pasillo
        $sql = "SELECT NUMERO_HUECOS_PASILLO FROM almacen";
        $resultadoHuecos = $conexion->query($sql);

        if ($resultadoHuecos->num_rows == 1) {
            $fila = $resultadoHuecos->fetch_assoc();  
            $NumeroHuecosTotal = $fila['NUMERO_HUECOS_PASILLO'];  //Obtengo el número de huecos que tiene el pasillo
        }

        //Número de huecos ocupados que hay en el pasillo
        $ArrayHuecosOcupados = array(); //Aquí guardo el número de huecos ocupados.
        
        $sql2 = $conexion->prepare("SELECT huecos_pasillos FROM pasillo WHERE id_pasillo= ?");
        $sql2->bind_param('s', $IdPasillo);
        $sql2->execute();
        $resultadoHuecosOcupados = $sql2->get_result();

        if ($resultadoHuecosOcupados->num_rows > 0) {
            $Obj = $resultadoHuecosOcupados->fetch_array()['huecos_pasillos'];

            while ($Obj) {
                $ArrayHuecosOcupados[] = $Obj; //al poner el array[] se va rellenando al siguiente
                $Obj = $resultadoHuecosOcupados->fetch_array()['huecos_pasillos'];
            }
        }
        
        //Guardo los numeros ocupados del pasillo
        $sql3 = $conexion->prepare("SELECT numero FROM estanteria WHERE pasillo= ?");
        $sql3->bind_param('s', $IdPasillo);
        $sql3->execute();
        $numeroOcupado = $sql3->get_result();

        $arrayNumeros = array();

        if ($numeroOcupado->num_rows > 0) {
            $Obj = $numeroOcupado->fetch_array()['numero'];

            while ($Obj) {
                $arrayNumeros[] = $Obj; 
                $Obj = $numeroOcupado->fetch_array()['numero'];
            }
        }

        //Creo el array de huecos disponibles
        $arrayDisponibles = array();

        for ($i = 1; $i <= $NumeroHuecosTotal; $i++) {
            if (!in_array($i, $arrayNumeros)) {
                $arrayDisponibles[] = $i;
            }
        }
        return $arrayDisponibles;
    }
        
    public function obtenerCaja($codigo) {
        global $conexion;
        $ArrayObjects = array();

        $OrdenSQL = $conexion->prepare("SELECT * FROM caja C, ocupacion_estanteria O, estanteria E WHERE C.CODIGO_CA=? AND O.id_caja=C.id_ca AND E.id_es = O.id_estanteria");
        $OrdenSQL->bind_param('s', $codigo);
        $OrdenSQL->execute();
        $resultado = $OrdenSQL->get_result();

        if ($resultado->num_rows > 0){
            $Obj = $resultado->fetch_object(); 

            while ($Obj) {
                $ArrayObjects[] = $Obj; 
                $Obj = $resultado->fetch_object();
            }
        }
                
        if (!empty($ArrayObjects)) {
            return $ArrayObjects;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'No hay registros de cajas';
            throw new CajaException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function SacarCaja($codigo) {

        global $conexion;
        $OrdenSQL = $conexion->prepare("DELETE FROM caja WHERE codigo_ca= ?");
        $OrdenSQL->bind_param('s', $codigo);
        $OrdenSQL->execute();
        $filasAfectadas = $OrdenSQL->affected_rows;

        if ($filasAfectadas != 1) {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Devolución de caja fallida';
            throw new EmpleadoException($Mensaje, $Codigo, $Lugar);
        } 
    }
    
    public function obtenerCajaBackup($codigo) {
        global $conexion;
        $ArrayObjects = array();

        $OrdenSQL = $conexion->prepare("SELECT * FROM caja_backup WHERE codigo_caja_back=?");
        $OrdenSQL->bind_param('s', $codigo);
        $OrdenSQL->execute();
        $resultado = $OrdenSQL->get_result();

        if ($resultado->num_rows > 0){
            $Obj = $resultado->fetch_object(); 

            while ($Obj) {
                $ArrayObjects[] = $Obj; 
                $Obj = $resultado->fetch_object();
            }
        }
                
        if (!empty($ArrayObjects)) {
            return $ArrayObjects;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'No hay registros de cajas';
            throw new CajaException($Mensaje, $Codigo, $Lugar);
        }
    }
    
    public function devolverCaja($CajaRetornar, $Estanteria){
        global $conexion;
        
        include_once "../Modelo/triggerReingresarCaja.php";

        $codigo = $CajaRetornar->getCodigo_ca();
        
        $OrdenSQL = $conexion->prepare("DELETE FROM caja_backup WHERE codigo_caja_back= ?");
        $OrdenSQL->bind_param('s', $codigo);
        $OrdenSQL->execute();
        $filasAfectadas = $OrdenSQL->affected_rows;

        if ($filasAfectadas != 1) {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Devolución de caja fallida';
            throw new CajaException($Mensaje, $Codigo, $Lugar);
        }
    }
    
    public function ComprobarUsuario() {
        global $conexion;
        $sql = "SELECT * FROM usuarios";
        $ExisteUsuario = $conexion->query($sql);
        if ($ExisteUsuario->num_rows == 1) {
            return true;
        } elseif ($ExisteUsuario->num_rows == 0) {
            return false;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'La comprobación del usuario ha fallado.';
            throw new UsuarioException($Mensaje, $Codigo, $Lugar);
        }
    }

    public function RegistrarUsuario($email, $password) {
        global $conexion;
        $Encriptado = password_hash($password, PASSWORD_BCRYPT);
        $OrdenSQL2 = $conexion->prepare("INSERT INTO usuarios (user,password) VALUES (?,?)");
        $OrdenSQL2->bind_param('ss', $email, $Encriptado);
        $OrdenSQL2->execute();
        $FilasAfectadas = $OrdenSQL2->affected_rows;
        if ($FilasAfectadas != 1) {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'El registro ha fallado';
            throw new UsuarioException($Mensaje, $Codigo, $Lugar);
        } else {
            return;
        }
    }
    
    public function IniciarSesion($email, $password) {
        global $conexion;
        
        $OrdenSQL = $conexion->prepare("SELECT * FROM usuarios WHERE user=?");
        $OrdenSQL->bind_param('s', $email);
        $OrdenSQL->execute();
        $resultado = $OrdenSQL->get_result();
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $passbd = $fila['password'];
        }

        if (password_verify($password, $passbd)) {
            return;
        } else {
            $Mensaje = $conexion->error;
            $Codigo = $conexion->errno;
            $Lugar = 'Inicio de sesión fallido';
            throw new UsuarioException($Mensaje, $Codigo, $Lugar);
        }
    }
}
