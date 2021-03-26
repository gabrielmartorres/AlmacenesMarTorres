<!doctype html>
<html lang="es">

    <head>
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
        <title>Almacenes Martorres - Menú Almacén</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    </head>

    <body>
        <?php include_once('Menus/VistaMenu.php'); ?>
        <header class="cabecera text-center">
            <h1>MENU DE GESTIÓN DE ALMACÉN</h1>
        </header>
        <section>
            <section>
                <?php include_once('Menus/SubmenuAlmacen.php'); ?>
            </section>
            <section>
                <div class="container tituloFormulario ">
                    <div class="row justify-content-center align-items-center minh-100">
                        <div class="col-lg-12">
                            <div>
                                <img class="img-fluid rounded mx-auto d-block" src="../../img/almacen.png" alt="logo" > <!-- width="25%" height="25%" -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="contenido">

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