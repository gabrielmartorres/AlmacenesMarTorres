<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ajax de lejas libres</title>
    </head>
    <body>
        <?php
        include '../../DAO/DAOGestion.php';
        
        $IdEstanteria = $_REQUEST['estanteriasdisponibles'];
        $arrayLejasDisponibles = DAOGestion::lejasDisponibles($IdEstanteria);
        ?>
        <!--<option value="nulo" selected="selected">Elije una leja</option>-->   
        <?php
        foreach ($arrayLejasDisponibles as $leja) {
        ?>
            <option value="<?php echo $leja ?>"><?php echo $leja ?></option>
        <?php
    }
    ?>
</body>
</html>

