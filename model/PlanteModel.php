<?php

include_once '../config/database.php';

class PlantModel{
    private $plantId;
    private $plantName;
    private $plantPrice;
    private $plantImage;
    private $IDcategory;
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
    public function showAllPlants()
    {
        $query = "SELECT plante.*, categorie.nomCateorie FROM plante JOIN categorie ON plante.idCategorie = categorie.idCategorie;";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createPlant()
    {
        $query = "INSERT INTO plante (nom, prix, image, idCategorie) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $this->plantName);
        $stmt->bindParam(2, $this->plantPrice);
        $stmt->bindParam(3, $this->plantImage);
        $stmt->bindParam(4, $this->IDcategory);

        $stmt->execute();
    }
    public function editPlante($plantId,$nomPlante, $prixPlante, $imageName, $catPlante)
    {
        $this->plantId = $plantId;
        $this->plantName = $nomPlante;
        $this->plantPrice = $prixPlante;
        $this->plantImage = $imageName;
        $this->IDcategory = $catPlante;

        $query = "UPDATE plante SET nom = ?, prix = ?, image = ?, idCategorie = ? WHERE idPlante = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomPlante);
        $stmt->bindParam(2, $prixPlante);
        $stmt->bindParam(3, $imageName);
        $stmt->bindParam(4, $catPlante);
        $stmt->bindParam(5, $plantId);

        $stmt->execute();
    }
    public function deletePlante($id)
    {
        $query = "DELETE FROM plante WHERE idPlante = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

    }

}
