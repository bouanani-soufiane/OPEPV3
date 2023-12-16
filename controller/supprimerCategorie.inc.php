<?php
include_once '../model/categorie.php';
$categId = $_GET['idCateg'];

$executing = new Categorie();
$executing->supprimerCateg($categId);

header('Location: ../views/dashboard.php?delete=success');

?>