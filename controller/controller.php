<?php
require_once '../config/database.php';
include_once 'userController.php';
include_once 'planteController.php';

$plantController = new PlantController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["ajouterPlante"])) {
        $nomPlante = $_POST['nomPlante'];
        $prixPlante = $_POST['pricePlante'];
        $catPlante = $_POST['catPlante'];

        $tmp_name = $_FILES['imagePlante']['tmp_name'];
        $imageName = file_get_contents($tmp_name);


        $plantController->__set("plantName", $nomPlante);
        $plantController->__set("plantPrice", $prixPlante);
        $plantController->__set("plantImage", $imageName);
        $plantController->__set("IDcategory", $catPlante);

        $plantController->createPlante($nomPlante, $prixPlante, $imageName, $catPlante);

        header("Location: ../views/dashboard.php?added=success");
    }
    if (isset($_POST["editPlante"])) {
        $plantId = $_POST['id'];
        $nomPlante = $_POST['nomPlanteEdit'];
        $prixPlante = $_POST['pricePlanteEdit'];
        $catPlante = $_POST['catPlanteEdit'];



        $tmp_name = $_FILES['imagePlanteEdit']['tmp_name'];

        $imageName = file_get_contents($tmp_name);


        $plantController->__set("plantName", $nomPlante);
        $plantController->__set("plantPrice", $prixPlante);
        $plantController->__set("plantImage", $imageName);
        $plantController->__set("IDcategory", $catPlante);

        $plantController->editPlante($plantId,$nomPlante, $prixPlante, $imageName, $catPlante);

        header("Location: ../views/dashboard.php?edited=success");
    }


}



if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['deletePlante'])){

        $plantController->deletePlant($_GET['deletePlante']);
        header("Location: ../views/dashboard.php?deleted=success");
    }
//    if(isset($_GET['kkk'])){
//        echo $_GET['deleteId'];
//        $plantController = new PlantController();
//        $plantController->deletePlant($_GET['deletePlantId']);
//        header('Location: ../../public/admin/plant.php?msg=deleted');
//    }

}