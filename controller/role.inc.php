<?php
include_once '../model/user.php';
session_start();
$emailUser =  $_SESSION['email'];
if (isset($_POST["role-submit"])) {

    $role = $_POST["role"];

    if (empty($role)) {
        header("Location: ../views/role.php?error=emptyfields");
        exit();
    }
    $executing = new User();
    $executing->ChoixRole($role,$emailUser);
    if ($role == "1") {
        $_SESSION["admin"] = "admin";
        header("Location: ../views/dashboard.php");
        exit();
    } else if ($role == "2") {
        $_SESSION["client"] = "client";
        header("Location: ../index.php");
        exit();
        }
} else {
    header("Location: ../views/signup.php?");
    exit();
}
