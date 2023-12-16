<?php
include_once '../model/theme.php';
$id = $_GET['idTheme'];

$executing = new Theme();
$executing->supprimerTheme($id);

header('Location: ../views/dashboard.php');

?>