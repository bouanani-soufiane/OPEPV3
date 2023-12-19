<?php

include_once '../config/database.php';

class CommandeModel{
    private $idCommande;
    private $numCommande;
    private $idPivotfk;

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

public function checkout()
{

    $query = "INSERT INTO commande (numCommande, idPivotfk) VALUES (?, ?)";
    $stmt1 = $this->db->prepare($query);
    $stmt1->bindParam(1, $this->numCommande);
    $stmt1->bindParam(2, $this->idPivotfk);
    $stmt1->execute();



}

    public function purchase()
    {
//        $query = "INSERT INTO plante (nom, prix, image, idCategorie) VALUES (?,?,?,?)";
//        $stmt = $this->db->prepare($query);
//
//        $stmt->bindParam(1, $this->plantName);
//        $stmt->bindParam(2, $this->plantPrice);
//        $stmt->bindParam(3, $this->plantImage);
//        $stmt->bindParam(4, $this->IDcategory);
//
//        $stmt->execute();
    }


}
