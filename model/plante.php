<?php
include_once '../config/database.php';

class Plante
{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function createPlante($nomPlante, $prixPlante, $new_img_name,$catPlante)
    {
        $query =  "insert into plante (nom,prix,image,idCategorie) values (?,?,?,?);";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomPlante);
        $stmt->bindParam(2, $prixPlante);
        $stmt->bindParam(3, $new_img_name);
        $stmt->bindParam(4, $catPlante);

        $stmt->execute();
    }
    public function showPlantes() {
        $query = "SELECT plante.*, categorie.nomCateorie FROM plante JOIN categorie ON plante.idCategorie = categorie.idCategorie";

        $statement = $this->db->prepare($query);

        $statement->execute();

        $categ = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $categ;
    }
    public function modifierPlantes($nomPlante, $prixPlante, $imageName, $catPlante, $id)
    {
        $query = "UPDATE plante SET nom = ?, prix = ?, image = ?, idCategorie = ? WHERE idPlante = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $nomPlante);
        $stmt->bindParam(2, $prixPlante);
        $stmt->bindParam(3, $imageName);  
        $stmt->bindParam(4, $catPlante);
        $stmt->bindParam(5, $id);

        $stmt->execute();
    }
    public function supprimerPlantes($id)
    {

        $query = "DELETE FROM plante WHERE idPlante = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();
    }

}