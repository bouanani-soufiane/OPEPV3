<?php
include_once '../model/plante.php';
if (isset($_POST["ajouterPlante"])) {
    $nomPlante = $_POST['nomPlante'];
    $prixPlante = $_POST['pricePlante'];
    $catPlante = $_POST['catPlante'];

    $tmp_name = $_FILES['imagePlante']['tmp_name'];

    $imageName = file_get_contents($tmp_name);

    if (empty($nomPlante) || empty($prixPlante) || empty($catPlante)) {
        header("Location: ../views/dashboard.php?error=emptyFields");
        exit();
    } else {
        $executing = new Plante(); // it an object or instance
        $executing->createPlante($nomPlante,$prixPlante,$imageName,$catPlante);
        header("Location: ../views/dashboard.php?added=success");

    }
}

