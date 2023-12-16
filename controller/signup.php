<?php
include_once '../model/user.php';
session_start();
if (isset($_POST["signup-submit"])) {
    $name = $_POST["uid"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatedPassword = $_POST["password-repeat"];
    if (empty($name) || empty($email) || empty($password) || empty($repeatedPassword)) {
        header("Location: ../views/signup.php?error=emptyfields");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z\s]+$/", $name)) {
        header("Location: ../views/signup.php?error=invalidemailUid");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/signup.php?error=invalidemail&uid=" . $name);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        header("Location: ../views/signup.php?error=invaliduid&email=" . $email);
        exit();
    } else if ($password !== $repeatedPassword) {
        header("Location: ../views/signup.php?error=passwordcheck&uid=" . $name . "&email=" . $email);
        exit();
    } else {
        $executing = new User();
        $executing->createUser($name, $email, $password);
        $_SESSION['email'] = $email ;
        header('Location: ../views/role.php?');
        exit();

    }
}

?>