<?php
include_once '../model/theme.php';
if (isset($_POST["editTheme"])) {
    $nomTheme = $_POST['nomTheme'];
    $descriptionTheme = $_POST['descriptionTheme'];

    $id = $_POST['id'];

    $tmp_name = $_FILES['imageTheme']['tmp_name'];

    $imageName = file_get_contents($tmp_name);

    if (empty($nomTheme) || empty($descriptionTheme) ) {
        header("Location: ../views/modifierTheme.php?error=emptyFields");
        exit();
    } else {
        $executing = new Theme(); // it an object or instance
        $executing->modifierTheme($nomTheme, $descriptionTheme, $imageName, $id);
        header("Location: ../views/dashboard.php?edited=success");
        exit();
    }
}

