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


}
