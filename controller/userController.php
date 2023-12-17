<?php
include_once '../model/userModel.php';

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new Users();
    }

    public function createUser($name, $email, $password, $idRole)
    {
        $newUser = new Users($name, $email, $password, $idRole);
        return $newUser;
    }
}



?>