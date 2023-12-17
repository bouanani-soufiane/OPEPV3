<?php
include_once '../model/userModel.php';

class UserController{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new Users();
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }

    public function createUser($name, $email, $password)
    {
        $this->userModel->__set("name", $name);
        $this->userModel->__set("email", $email);
        $this->userModel->__set("password", $password);

        $this->userModel->createUser($name, $email, $password);
    }
    public function chooseRole($idrole,$email)
    {
        $this->userModel->__set("idRole", $idrole);
        $this->userModel->__set("email", $email);

        $this->userModel->chooseRole($idrole, $email);
    }
    public function retriveId($email){
        return $this->userModel->retriveId($email);
    }

}
?>
