<?php
include('../model/plante.php');
    function allPlante(){
        $plante = new Plante();
        $plantes = $plante->showPlantes();
        return $plantes;
    }
?>
