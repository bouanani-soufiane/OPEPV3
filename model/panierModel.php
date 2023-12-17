<?php

include_once '../config/database.php';

class PanierModel
{
    private $idPanier;
    private $idUser;


    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }
    public function createPanier($idUser)
    {
        $this->idUser = $idUser;

        $query = "insert into panier (idUser ) values (?)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $this->idUser);

        $stmt->execute();
    }
    public function retriveId($idUser)
    {
        $query = "SELECT idPanier FROM panier WHERE idUser = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $idUser);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && isset($result['idPanier'])) {
            return $result['idPanier'];
        }
        return null;
    }
}
