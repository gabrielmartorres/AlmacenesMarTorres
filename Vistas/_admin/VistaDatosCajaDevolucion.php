<!doctype html>
<html lang="es">

    <head>
        <?php
        include_once '../../Modelo/Caja.php';
        include_once '../../Modelo/Estanteria.php';
        session_start();
        $ArrayObj = $_SESSION['ArrayObjCaja'];
        $ArrayObjEstanteria = $_SESSION['ArrayObjEstanteria'];
        $Codigocaja = "";
        $opcion = $_REQUEST['opcion'];
        $opciones = $_SESSION['opciones'] = $opcion;
        ?>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../img/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../../img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../css/style.css">

        <!-- Fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Heebo|Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700&display=swap" rel="stylesheet">

        <!-- Iconos -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- https://www.w3schools.com/icons/fontawesome_icons_webapp.asp -->
        <title>Almacenes Martorres - Menú Estanterías</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    </head>

    <body>
        <?php include_once('Menus/VistaMenu.php'); ?>
        <header class="cabecera text-center">
            <h1>DEVOLUCIÓN DE MERCANCÍAS</h1>
        </header>
        <section>
            <?php include_once('Menus/SubmenuAlmacen.php'); ?>
        </section>
        <section>
            <div class="container tituloFormulario">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Información de la caja a devolver</h2>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid formulario">
                <?php
                if ($opciones == "devolucion") {
                    ?>
                    <form name="altaCaja" action="../../Controladores/ControladorDevolverCajaCaja.php" method="POST">
                        <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <table class="table table-sm table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Medidas</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Material</th>
                                        <th scope="col">Contenido</th>
                                        <th scope="col">Fecha de alta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($ArrayObj as $Object) {
                                        $fechaOriginal = $Object->fecha_alta_caja_back;
                                        $nuevaFecha = date("d/m/Y", strtotime($fechaOriginal));
                                        $Codigocaja = $Object->codigo_caja_back;
                                        ?>
                                        <tr>
                                            <th name="codigoCaja" scope="row"><?= $Object->codigo_caja_back; ?></th>
                                            <td>
                                                <?= $Object->altura_caja_back; ?> x
                                                <?= $Object->anchura_caja_back; ?> x
                                                <?= $Object->profundidad_caja_back; ?>
                                            </td>
                                            <td><label class="colorCaja" style="background-color: <?= $Object->color_caja_back; ?>;"><label></td>
                                                        <td><?= $Object->material_caja_back; ?></td>
                                                        <td><?= $Object->contenido_caja_back; ?></td>
                                                        <td><?= $nuevaFecha; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    <tr>

                                                    </tr>
                                                    <tr>
                                                        <th scope="col" colspan="6"><br>Nueva ubicación de la caja: </th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <select class="form-control" name="estanteriasdisponibles" onchange="cargarLejasLibres(this.value)" required>
                                                                <option selected>Elije una estanteria</option>
                                                                <?php
                                                                foreach ($ArrayObjEstanteria as $Object) {
                                                                    if ($Object->getPasillo() == 1) {
                                                                        $Object->setPasillo("A");
                                                                    } elseif ($Object->getPasillo() == 2) {
                                                                        $Object->setPasillo("B");
                                                                    } elseif ($Object->getPasillo() == 3) {
                                                                        $Object->setPasillo("C");
                                                                    }
                                                                    ?>

                                                                    <option value="<?php echo $Object->getId_es(); ?>"><?php echo "Codigo: " . $Object->getCodigo_es() . " - Pasillo " . $Object->getPasillo() . " - Número " . $Object->getNumero(); ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td colspan="2">
                                                            <select class="form-control" name="lejasLibres" id="lejasLibres" required>
                                                                <option value="nulo" selected="selected">Elije una leja</option>
                                                            </select>
                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4"></div>
                                                        <div class="col-lg-4">
                                                            <?php
                                                            if ($opciones == "salida") {
                                                                ?>
                                                                <form name="altaCaja" action="../../Controladores/ControladorSacarCaja.php" method="POST">
                                                                <?php }
                                                                ?>   
                                                                <div class="form-group row">
                                                                    <div class="col-sm-2">
                                                                        <input class ="d-none" type="text" name="codigoCaja" value="<?php echo $Codigocaja; ?>">
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <button type="submit" class="btn btn-success mb-2">ACEPTAR</button>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <button type="button" style="float: right;" class="btn btn-danger mb-2" onClick="self.location.href = 'VistaBuscadorCaja.php?opcion=devolucion'">CANCELAR</button>
                                                                    </div>
                                                                    <div class="col-sm-2"></div>
                                                                </div>

                                                                <?php
                                                                if ($opciones == "salida") {
                                                                    ?>
                                                                </form>
                                                            <?php }
                                                            ?>  
                                                        </div>
                                                        <div class="col-lg-4"></div>
                                                    </div>
                                                    </div>
                                                    <?php
                                                    if ($opciones == "devolucion") {
                                                        ?>
                                                        </form>
                                                        <?php
                                                    }
                                                    ?>
                                                    </section>


                                                    <footer>
                                                        <?php include_once('./Foorter/VistaFooter.php'); ?>
                                                    </footer>


                                                    <!-- Optional JavaScript -->
                                                    <script src="../../js/cargarEstanteria.js"></script>
                                                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                                                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                                                    </body>

                                                    </html>