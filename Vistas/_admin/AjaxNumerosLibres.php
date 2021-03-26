<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ajax de lejas libres</title>
    </head>
    <body>
        <?php
        include '../../DAO/DAOGestion.php';
        
        $IdPasillo = $_REQUEST['pasillosdisponibles'];
        $arrayNumerosDisponibles = DAOGestion::numerosDisponibles($IdPasillo);
       
                    
        foreach ($arrayNumerosDisponibles as $numero) {
        ?>
            <option value="<?php echo $numero ?>"><?php echo $numero ?></option>
        <?php
    }
    ?>
</body>
</html>

