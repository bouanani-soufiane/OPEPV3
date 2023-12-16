<?php
include_once '../model/plante.php';
if (isset($_POST["editPlante"])) {
    $nomPlante = $_POST['nomPlanteEdit'];
    $prixPlante = $_POST['pricePlanteEdit'];
    $catPlante = $_POST['catPlanteEdit'];
    $id = $_POST['id'];


    $tmp_name = $_FILES['imagePlanteEdit']['tmp_name'];

    $imageName = file_get_contents($tmp_name);

    if (empty($nomPlante) || empty($prixPlante) || empty($catPlante)) {
        header("Location: ../views/modifierPlante.php?error=emptyFields");
        exit();
    } else {
        $executing = new Plante(); // it an object or instance
        $executing->modifierPlantes($nomPlante, $prixPlante, $imageName, $catPlante, $id);
        header("Location: ../views/dashboard.php?edited=success");
        exit();
    }
}

