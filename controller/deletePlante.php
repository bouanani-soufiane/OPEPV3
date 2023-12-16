<?php
include_once '../model/plante.php';
    $productId = $_GET['idPlante'];

    $executing = new Plante();
    $executing->supprimerPlantes($productId);

    header('Location: ../views/dashboard.php');

?>