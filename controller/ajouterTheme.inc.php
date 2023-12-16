<?php
include_once '../model/theme.php';
if (isset($_POST["ajouterTheme"])) {
    $nomTheme = $_POST['nomTheme'];
    $descriptionTheme = $_POST['descriptionTheme'];

    $tmp_name = $_FILES['imageTheme']['tmp_name'];

    $imageName = file_get_contents($tmp_name);

    if (empty($nomTheme) || empty($descriptionTheme) ) {
        header("Location: ../views/dashboard.php?error=emptyFields");
        exit();
    } else {
        $executing = new Theme();
        $executing->createTheme($nomTheme,$imageName,$descriptionTheme);
        header("Location: ../views/dashboard.php?added=success");

    }
}

