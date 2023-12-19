<?php
class Users{
    private $name;
    private $email;
    private $password;
    private $idRole;
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("Undefined property: $property");
        }
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("Undefined property: $property");
        }
    }
    public function createUser($name, $email, $passwordUser){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($passwordUser, PASSWORD_DEFAULT);

        $query = "INSERT INTO `utilisateur` (`nom`, `email`, `passwordUser`, `idRole`) VALUES (?, ?, ?, null)";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->email);
        $stmt->bindValue(3, $this->password);

        $stmt->execute();
    }
    public function chooseRole($idrole,$email)
    {
        $this->idRole = $idrole;
        $this->email = $email;
        $query = "update utilisateur set idRole = ? where email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $this->idRole);
        $stmt->bindValue(2, $this->email);
        $stmt->execute();
    }
    public function retriveId($email)
    {
        $query = "SELECT idUser FROM utilisateur WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && isset($result['idUser'])) {
            return $result['idUser'];
        }
        return null;
    }
    public function retriveRole($email)
    {
        $query = "SELECT idRole FROM utilisateur WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && isset($result['idRole'])) {
            return $result['idRole'];
        }
        return null;
    }
    public function login($email, $password){
        $query = "SELECT idUser, passwordUser FROM utilisateur WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result['passwordUser'])) {
            return $result['idUser'];
        } else {
            return null;
        }
    }




}

?>
