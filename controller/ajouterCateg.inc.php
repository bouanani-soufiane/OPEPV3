<?php
include_once '../model/categorie.php';
if (isset($_POST["ajouterCateg"])) {
    $nomCateg = $_POST['nomCateg'];

    if (empty($nomCateg)) {
        header("Location: ../views/dashboard.php?error=emptyFields");
        exit();
    } else {
        $executing = new Categorie();
        $executing->createCategorie($nomCateg);
        header("Location: ../views/dashboard.php?success=added");
        exit();
    }
}

