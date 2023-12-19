<?php
require_once '../config/database.php';
include_once 'userController.php';
include_once 'planteController.php';
include_once 'categorieController.php';
include_once 'panierController.php';
include_once  'panierPlanteController.php';
include_once 'commandeController.php';
include '../function.php';

$plantController = new PlantController();
$categController = new categorieController();
$userController = new UserController();
$panierController = new PanierController();
$PanierPlanteController = new PanierPlanteController();
$commandeController = new CommandeController();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["ajouterPlante"])) {
        $nomPlante = $_POST['nomPlante'];
        $prixPlante = $_POST['pricePlante'];
        $catPlante = $_POST['catPlante'];

        $tmp_name = $_FILES['imagePlante']['tmp_name'];
        $imageName = file_get_contents($tmp_name);

        $plantController->__get('plantModel')->__set("plantName", $nomPlante);
        $plantController->__get('plantModel')->__set("plantPrice", $prixPlante);
        $plantController->__get('plantModel')->__set("plantImage", $imageName);
        $plantController->__get('plantModel')->__set("IDcategory", $catPlante);

        $plantController->createPlante($plantController->__get('plantModel'));

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
            $idUser = $userController->retriveId($email);
            $panierController->createPanier($idUser);
            $idPanier = $panierController->retriveId($idUser);
            $_SESSION['client'] = "client";
            $_SESSION['idUser'] = $idUser;
            $_SESSION['idPanier'] = $idPanier;
            header("Location: ../views/shop.php?");

        }

    }
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $idRole = $userController->retriveRole($email);
        $loggedInUserId = $userController->login($email, $password);

        if ($loggedInUserId !== null && $idRole == 1) {
            $_SESSION['admin'] = "admin";
            header("Location: ../views/dashboard.php");
            exit();
        } elseif ($loggedInUserId !== null && $idRole == 2) {
            $idUser = $userController->retriveId($email);
            $idPanier = $panierController->retriveId($idUser);
            $_SESSION['client'] = "client";
            $_SESSION['idUser'] = $idUser;
            $_SESSION['idPanier'] = $idPanier;

            header("Location: ../views/shop.php");
            exit();
        } else {
            // Invalid login credentials
            echo "Invalid email or password";
        }
    }
    if (isset($_POST["filterByCateg"])) {
        $placeholders =  $plantController->filterByCateg($_POST["filter"]);
        dd($placeholders);
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
    if(isset($_GET['logout'])){
        $userController->logout();
        header("Location: ../views/signUp.php");
    }
    if (isset($_GET["addToPanier"])) {
        $idPlante = $_GET['addToPanier'];
        $idPanier = $_SESSION['idPanier'];

        $PanierPlanteController->__get('PanierplanteModel')->__set("plante_id", $idPlante);
        $PanierPlanteController->__get('PanierplanteModel')->__set("panier_id", $idPanier);


        $PanierPlanteController->addToPanier($PanierPlanteController->__get('PanierplanteModel'));

        header("Location: ../views/shop.php?added=success");
    }
    if(isset($_GET['deleteFromPanier'])){
        $PanierPlanteController->deleteFromPanier($_GET['deleteFromPanier']);
        header("Location: ../views/panier.php?deleted=success");
    }
    if (isset($_GET["commander"])) {
        $idPivot = $_GET['idPivot'];
        $idPlante = $_GET['idPlante'];
        $numCommande = mt_rand(100, 100000);

        $commandeController->__get('CommandeModel')->__set("numCommande", $numCommande);
        $commandeController->__get('CommandeModel')->__set("idPivotfk", $idPivot);

        $commandeController->checkout($commandeController->__get('CommandeModel'));

        $PanierPlanteController->updateStatusQtt($idPlante);

        header("Location: ../views/panier.php?checkout=success");
    }


}


// Check if data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON-encoded data from the request body
    $postData = file_get_contents('php://input');

    // Decode the JSON data into a PHP associative array
    $data = json_decode($postData, true);

    // Check if decoding was successful
    if ($data !== null) {
        // Access the array of data
        $dataArray = $data['data'];

        // Handle the data as needed
        // For example, you can loop through the array
        foreach ($dataArray as $value) {
            echo $value . "\n";
        }
    } else {
        // Handle JSON decoding error
        echo 'Error decoding JSON data';
    }
} else {
    // Handle invalid request method
    echo 'Invalid request method';
}


