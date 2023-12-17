<?php
session_start();
require_once '../config/database.php';
include_once 'userController.php';
include_once 'planteController.php';
include_once 'categorieController.php';
include_once 'panierController.php';

$plantController = new PlantController();
$categController = new categorieController();
$userController = new UserController();
$panierController = new PanierController();



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
    if (isset($_POST["ajouterCateg"])) {
        $nomCateg = $_POST['nomCateg'];
        $categController->createCateg($nomCateg);
        header("Location: ../views/dashboard.php?added=success");
    }
    if (isset($_POST["editCateg"])) {
        $idCateg = $_POST['id'];
        $nomCateg = $_POST['nomCategEdit'];
        $categController->editCateg($idCateg,$nomCateg);
        header("Location: ../views/dashboard.php?edited=success");
    }
    if (isset($_POST["signup-submit"])) {
        $name = $_POST["uid"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatedPassword = $_POST["password-repeat"];

        $userController->__set("name", $name);
        $userController->__set("email", $email);
        $userController->__set("password", $password);

        $userController->createUser($name, $email, $password);

        $_SESSION['email'] = $email;

        header("Location: ../views/role.php?");
    }
    if (isset($_POST["role-submit"])) {
        $role = $_POST["role"];
        $email = $_SESSION["email"];

        $userController->__set("idrole", $role);
        $userController->__set("email", $email);
        $userController->chooseRole($role,$email);

        if($role == 1){
            $_SESSION['admin'] = "admin";
            header("Location: ../views/dashboard.php?");

        }elseif ($role == 2){
            $_SESSION['client'] = "client";
            $idUser = $userController->retriveId($email);
            $panierController->createPanier($idUser);

            header("Location: ../views/shop.php?");


        }

    }

}



if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['deletePlante'])){
        $plantController->deletePlant($_GET['deletePlante']);
        header("Location: ../views/dashboard.php?deleted=success");
    }
    if(isset($_GET['deleteCateg'])){
        $categController->deleteCateg($_GET['deleteCateg']);
        header("Location: ../views/dashboard.php?deleted=success");

    }

}