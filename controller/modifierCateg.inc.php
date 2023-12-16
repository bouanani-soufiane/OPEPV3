<?php
include_once '../model/categorie.php';
if (isset($_POST["editCateg"])) {
    $nomCategEdit = $_POST['nomCategEdit'];
    $id = $_POST['id'];
//    echo "<pre>";
//    print_r($_POST);
//    echo "<pre>";
    if (empty($nomCategEdit) ) {
        header("Location: ../views/modifierCategorie.php?error=emptyFields");
        exit();
    } else {
        $executing = new Categorie(); // it an object or instance
        $executing->modifierCateg($nomCategEdit,$id);
        header("Location: ../views/dashboard.php?edited=success");
        exit();
    }
}
