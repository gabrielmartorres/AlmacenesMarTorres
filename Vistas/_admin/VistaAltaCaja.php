<!doctype html>
<html lang="es">

    <head>
        <?php
        include_once '../../Modelo/Estanteria.php';
        session_start();
        $ArrayObjEstanteria = $_SESSION['ArrayObjEstanteria'];
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
            <h1>ALTA DE CAJAS</h1>
        </header>
        <section>
            <?php include_once('Menus/SubmenuCaja.php'); ?>
        </section>
        <section>
            <div class="container tituloFormulario">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Formulario de alta</h2>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid formulario">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <form name="altaCaja" action="../../Controladores/ControladorAltaCaja.php" method="POST">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Código:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="codigo" class="form-control" id="inputPassword" placeholder="Código" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Medidas:</label>

                                <div class="col-sm-10">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Altura:</label>
                                        <div class="col-sm-10">
                                            <div class="col-sm-8"><input type="number" min="1" step="any" name="altura" class="form-control" id="inputPassword" placeholder="Altura" required></div>
                                        </div>
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Anchura:</label>
                                        <div class="col-sm-10">
                                            <div class="col-sm-8"><input type="number" min="1" step="any" name="anchura" class="form-control" id="inputPassword" placeholder="Anchura" required></div>
                                        </div>
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Profundidad:</label>
                                        <div class="col-sm-10">
                                            <div class="col-sm-8"><input type="number" min="1" step="any" name="profundidad" class="form-control" id="inputPassword" placeholder="Profundidad" required></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Color:</label>
                                <div class="col-sm-10">
                                    <input type="color" name="color" class="form-control" id="inputPassword" placeholder="Color" style="width: 100px;" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Material:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="material" class="form-control" id="inputPassword" placeholder="Material" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Contenido:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="contenido" class="form-control" id="inputPassword" placeholder="Contenido" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Estantería:</label>
                                <div class="col-sm-10">
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
                                </div>
                            </div>
                            <div class="form-group row">

                                <label for="inputPassword" class="col-sm-2 col-form-label">Leja:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="lejasLibres" id="lejasLibres" required>
                                        <option value="nulo" selected="selected">Elije una leja</option>

                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">INSERTAR</button>

                        </form>
                    </div>
                    <div class="col-lg-4"></div>
                </div>

            </div>
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