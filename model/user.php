<?php
require '../config/database.php';

class User
{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function createUser($name, $email, $passwordUser)
    {
        $query = "INSERT INTO `utilisateur` (`nom`, `email`, `passwordUser`, `idRole`) VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $hashedpdw = password_hash($passwordUser, PASSWORD_DEFAULT);

        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $hashedpdw);
        $stmt->bindValue(4, null, PDO::PARAM_NULL);

        $stmt->execute();
    }
    public function ChoixRole ($role,$email){
        $query = "update utilisateur set idRole = ? where email = ? ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $role);
        $stmt->bindParam(2, $email);
        $stmt->execute();
    }
}
