<!doctype html>
<html lang="es">

    <head>
        <?php
        include_once '../../Modelo/Estanteria.php';
        include_once '../../Modelo/Caja.php';
        session_start();
        $ArrayObj = $_SESSION['ArrayObjInventario'];
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
            <h1>INVENTARIO</h1>
        </header>
        <section>
            <?php include_once('Menus/SubmenuAlmacen.php'); ?>
        </section>
        <section>
            <div class="container tituloFormulario">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Listado general de inventario</h2>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid formulario">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <table class="table table-sm table-dark">
                            <?php
                            $pasa = true;
                            $cod = "";
                            foreach ($ArrayObj as $Object) {

                                if ($cod == $Object->codigo_es) {
                                    $pasa = false;
                                } else {
                                    $pasa = true;
                                }

                                if ($pasa == true) {
                                    $cod = $Object->codigo_es;
                                    //Ordenar la fecha por d/m/a
                                    $fechaOriginalE = $Object->fecha_alta_estanteria;
                                    $nuevaFechaE = date("d/m/Y", strtotime($fechaOriginalE));
                                    ?>   
                                    <!-- FILAS PARA ESTANTERIA-->
                                    <thead>
                                        <tr>
                                            <th colspan="6" scope="col">Estantería: <?= $Object->codigo_es; ?></th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th scope="col">Material</th>
                                            <th scope="col">Nº de lejas</th>
                                            <th scope="col">Nº de lejas ocupadas</th>
                                            <th scope="col">Fecha de alta</th>
                                            <th scope="col">Pasillo</th>
                                            <th scope="col">Número</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $Object->material_estanteria; ?></td>
                                            <td><?= $Object->numLejas; ?></td>
                                            <td><?= $Object->lejas_ocupadas; ?></td>
                                            <td><?= $nuevaFechaE; ?></td>
                                            <td><?= $Object->letra_pasillo; ?></td>
                                            <td><?= $Object->numero; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    if ($Object->CODIGO_CA != NULL) {
                                        //Ordenar la fecha por d/m/a
                                        $fechaOriginalC = $Object->FECHA_ALTA_CAJA;
                                        $nuevaFechaC = date("d/m/Y", strtotime($fechaOriginalC));
                                        ?>  
                                        <!-- FILAS PARA CAJA--> 

                                        <tr class="bg-primary">
                                            <th scope="col">Nº de leja: <?= $Object->leja_ocupada; ?></th>
                                        </tr>

                                        <tr class="bg-success">
                                            <th scope="col">Código Caja:</th>
                                            <th scope="col">Medidas</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Material</th>
                                            <th scope="col">Contenido</th>
                                            <th scope="col">Fecha de alta</th>
                                        </tr>
                                        <tr class="bg-success">
                                            <th scope="row"><?= $Object->CODIGO_CA; ?></th>
                                            <td><?= $Object->ALTURA; ?> x <?= $Object->ANCHURA; ?> x <?= $Object->PROFUNDIDAD; ?></td>
                                            <td><label class="colorCaja" style="background-color: <?= $Object->COLOR; ?>"></label></td>
                                            <td><?= $Object->MATERIAL_CAJA; ?></td>
                                            <td><?= $Object->CONTENIDO; ?></td>
                                            <td><?= $nuevaFechaC; ?></td>
                                        </tr>
                                        <?php
                                    }//if
                                    else {
                                        echo "<tr class='bg-danger'><td colspan='6'>Sin Cajas</td></tr>";
                                    }
                                }//foreach
                                ?>    

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </div>
        </section>


        <footer>
            <?php include_once('./Foorter/VistaFooter.php'); ?>
        </footer>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>